<?php

namespace App\Http\Livewire\Manage\Wilayah;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\{
    Keuangan\JurnalHarian,
};
use App\Helpers\{
    SectorData,
    StringGenerator,
};

class LvFilterData extends Component
{
    private $sector_properties;
    
    public $page_attribute = [
        'title' => 'Jurnal Harian',
    ];
    
    public $selected_item;
    public $selected_url;
    
    public $selected_sector_id;
    public $sector_name;
    
    public function render()
    {
        $table_pusat = Config::get("database.connections.mysql.database").".jurnal_harians";
        $databases = SectorData::getAllDatabases();
        $main_query = null;
        foreach ($databases as $key => $value) {
            if($key == 0) {
                Config::set('database.connections.sector_db.database', $value);
                DB::purge('sector_db');
                $main_query = JurnalHarian::on('sector_db');
            } else {
                $sub_query = DB::table("{$value}.jurnal_harians");
                $main_query = $main_query->unionAll($sub_query);
            }
        }
        $main_query = $main_query->with(['jurnal_pusat' => function ($query) use($table_pusat)
        {
            $query->from($table_pusat);
        }])
        ->orderBy('created_at', 'DESC')->get();
        // dd($main_query->toArray());
        $data['sector_items'] = $main_query;
        return view('livewire.manage.wilayah.lv-filter-data')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
    
    public function setSector($sector_id, $attributes = ['notification' => false])
    {
        $sector_properties = SectorData::getPropertiesById($sector_id);
        if($sector_properties) {
            $this->sector_properties = $sector_properties;
            return true;
        }
        if($attributes['notification']) {
            $this->dispatchBrowserEvent('notification:show', ['type' => 'warning', 'title' => 'Ops!', 'message' => "Sorry we can't find any data, try again later."]);
        }
        return false;
    }
    
    public function setSectorId($sector_id)
    {
        $exists = $this->setSector($sector_id, ['notification' => true]);
        if($exists) {
            $this->selected_sector_id = $sector_id;
            $this->control_tabs = [
                'sector_list' => false,
                'sector_detail' => true,
            ];
        }
    }
    
    public function setItem($id, $sector_id = null)
    {
        $query = JurnalHarian::query();
        if ($sector_id) {
            $exists = $this->setSector($sector_id, ['notification' => true]);
            if ($exists) {
                Config::set('database.connections.sector_db.database', $this->sector_properties['db_name']);
                DB::purge('sector_db');
                $query = JurnalHarian::on('sector_db');
            }
        }
        $item = $query->where('id', $id)->firstOrFail();
        $this->selected_item = $item->toArray();
        
        $this->selected_url = route('files.image.sector.stream', ['path' => $item->sector_id.'/'.$item->base_path, 'name' => $item->image_name]);
    }
    
    public function downloadImage($sector_id = null)
    {
        $query = JurnalHarian::query();
        if ($sector_id) {
            $exists = $this->setSector($sector_id, ['notification' => true]);
            if ($exists) {
                Config::set('database.connections.sector_db.database', $this->sector_properties['db_name']);
                DB::purge('sector_db');
                $query = JurnalHarian::on('sector_db');
            }
        }
        $item = $query->where('id', $this->selected_item['id'])->firstOrFail();
        $path = $item->sector_id.'/'.$item->base_path.$item->image_name;
        
        return Storage::disk('sector_base')->download($path, $item->image_real_name);
    }
    
    public function copyDataSector($id, $sector_id)
    {
        $exists = $this->setSector($sector_id, ['notification' => true]);
        if ($exists) {
            Config::set('database.connections.sector_db.database', $this->sector_properties['db_name']);
            DB::purge('sector_db');
            $item = JurnalHarian::on('sector_db')
            ->where('id', $id)
            ->firstOrFail();
            
            $is_accepted = JurnalHarian::where('origin_uuid', $item->uuid)->first();
            
            if($is_accepted) {
                return $this->dispatchBrowserEvent('notification:show', ['type' => 'warning', 'title' => 'Ops!', 'message' => 'Data already accepted.']);
            }
            
            $re_item = $item->replicate();
            $re_item->setConnection('mysql');
            $re_item->origin_uuid = $re_item->uuid;
            $re_item->origin_sector_id = $re_item->sector_id;
            $re_item->sector_id = Config::get('app.sector_id');
            
            $old_path = $item->sector_id.'/'.$re_item->base_path.$re_item->image_name;
            $extension = pathinfo(Storage::disk('sector_base')->path($old_path), PATHINFO_EXTENSION);
            $new_filename = StringGenerator::fileName($extension);
            $new_path = $re_item->sector_id.'/'.$re_item->base_path.$new_filename;
            
            $re_item->image_name = $new_filename;
            $re_item->save();
            
            Storage::disk('sector_base')->copy($old_path, $new_path);
            return $this->dispatchBrowserEvent('notification:show', ['type' => 'success', 'title' => 'Success!', 'message' => 'Successfully storing data.']);
            // dd($re_item);
        }
        return;
    }
}
