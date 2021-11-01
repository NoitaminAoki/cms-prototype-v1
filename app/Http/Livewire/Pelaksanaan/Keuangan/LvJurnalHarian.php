<?php

namespace App\Http\Livewire\Pelaksanaan\Keuangan;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    Keuangan\JurnalHarian,
};
use App\Helpers\StringGenerator;

class LvJurnalHarian extends Component
{
    use WithFileUploads;
    
    protected $listeners = [
        'evSetInputTanggal' => 'setInputTanggal',
    ];
    
    public $page_attribute = [
        'title' => 'Jurnal Harian',
    ];
    public $page_permission = [
        'add' => 'jurnal-harian add',
        'delete' => 'jurnal-harian delete',
    ];
    
    public $control_tabs = [
        'list' => true,
        'detail' => false,
    ];
    
    public $file_image;
    public $input_tanggal;
    public $iteration;
    
    public $items;
    public $selected_item_group = [];
    public $selected_group_name;
    public $selected_item;
    public $selected_url;
    
    public function render()
    {
        $items = JurnalHarian::query()
        ->select('*')
        ->selectRaw('DATE_FORMAT(tanggal, "%M %Y") as date')
        ->orderBy('tanggal', 'ASC')
        ->get()
        ->groupBy('date');


        $this->items = collect($items)->map(function ($values, $index)
        {
            return [
                'name' => $index,
                'items' => $values,
            ];
        });
        
        if ($this->selected_group_name) {
            $item = $this->items->where('name', $this->selected_group_name)->first();
            $this->selected_item_group = $item['items'] ?? [];
        }
        
        return view('livewire.pelaksanaan.keuangan.lv-jurnal-harian')
        ->with([])
        ->layout('layouts.dashboard.main');
    }
    
    public function addItem()
    {
        $this->validate([
            'file_image' => 'required|image',
            'input_tanggal' => 'required|string',
        ]);
        $date_now = date('Y-m-d H:i:s', strtotime($this->input_tanggal));
        $image_name = StringGenerator::fileName($this->file_image->extension());
        $image_path = Storage::disk('sector_disk')->putFileAs(JurnalHarian::BASE_PATH, $this->file_image, $image_name);
        
        $insert = JurnalHarian::create([
            'image_real_name' => $this->file_image->getClientOriginalName(),
            'image_name' => $image_name,
            'tanggal' => $date_now,
        ]);
        
        $this->resetInput();
        
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => 'Successfully adding data.']);
    }
    
    public function setInputTanggal($value)
    {
        $this->input_tanggal = $value;
    }
    
    public function resetInput()
    {
        $this->reset('file_image', 'selected_item');
        $this->input_tanggal = date('m/d/Y');
        $this->iteration++;
    }
    
    public function setItem($id)
    {
        $item = JurnalHarian::findOrFail($id);
        $this->selected_item = $item;
        $this->selected_url = route('files.image.stream', ['path' => $item->base_path, 'name' => $item->image_name]);
    }
    
    public function setGroupName($name)
    {
        $this->selected_group_name = $name;
        $this->control_tabs = [
            'list' => false,
            'detail' => true,
        ];
    }
    
    public function openList()
    {
        $this->control_tabs = [
            'list' => true,
            'detail' => false,
        ];
    }
    
    public function downloadImage()
    {
        $item = JurnalHarian::findOrFail($this->selected_item['id']);
        $path = $item->full_path;
        
        return Storage::disk('sector_disk')->download($path, $item->image_real_name);
    }
    
    public function delete($id)
    {
        $item = JurnalHarian::findOrFail($id);
        $path = $item->full_path;
        Storage::disk('sector_disk')->delete($path);
        $item->delete();
        $this->resetInput();
        return ['status_code' => 200, 'message' => 'Data has been deleted.'];
    }
}
