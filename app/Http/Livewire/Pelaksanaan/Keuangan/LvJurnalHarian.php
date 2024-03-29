<?php

namespace App\Http\Livewire\Pelaksanaan\Keuangan;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    Keuangan\JurnalHarian,
    Keuangan\ResumeJurnal,
};
use App\Helpers\StringGenerator;

class LvJurnalHarian extends Component
{
    use WithFileUploads;
    
    protected $listeners = [
        'evSetInputTanggal' => 'setInputTanggal',
    ];
    
    public $page_attribute = [
        'title' => 'Jurnal Keuangan',
    ];
    public $page_permission = [
        'add' => 'jurnal-harian add',
        'delete' => 'jurnal-harian delete',
    ];
    
    public $control_tabs = [
        'list' => true,
        'detail' => false,
    ];
    
    public $tipe_jurnal;
    public $file_image;
    public $input_tanggal;
    public $iteration;
    
    public $items;
    public $selected_item_group = [];
    public $selected_group_name;
    public $selected_item;
    public $selected_url;
    
    public function mount()
    {
        $this->tipe_jurnal = 'jurnal';
    }
    
    public function render()
    {
        $resume_items = ResumeJurnal::query()
        ->select('*')
        ->selectRaw('DATE_FORMAT(tanggal, "%M %Y") as date, "resume" as type');
        
        $items = JurnalHarian::query()
        ->select('*')
        ->selectRaw('DATE_FORMAT(tanggal, "%M %Y") as date, "jurnal" as type')
        ->unionAll($resume_items)
        ->orderBy('type', 'DESC')
        ->orderBy('tanggal', 'ASC')
        ->get()
        ->groupBy('date');
        
        
        $this->items = collect($items)->map(function ($values, $index)
        {
            $data_items = array_values(collect($values)->sortByDesc('type')->toArray());
            // dump($data_items);
            return [
                'name' => $index,
                'main_items' => $data_items ?? [],
            ];
        });
        // dd($items->toArray(), $this->items);
        if ($this->selected_group_name) {
            $item = $this->items->where('name', $this->selected_group_name)->first();
            $this->selected_item_group = $item['main_items'] ?? [];
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
            'tipe_jurnal' => 'required|string',
        ]);
        $model = null;
        if($this->tipe_jurnal == 'resume') {
            $model = ResumeJurnal::class;
        } elseif($this->tipe_jurnal == 'jurnal') {
            $model = JurnalHarian::class;
        } else {
            return $this->dispatchBrowserEvent('notification:show', ['type' => 'error', 'title' => 'Ops!', 'message' => "We tried it, but failed when requesting data to the server, sorry."]);
        }
        $date_parse = str_replace('/', '-', $this->input_tanggal);
        $date_now = date('Y-m-d H:i:s', strtotime($date_parse));
        $image_name = StringGenerator::fileName($this->file_image->extension());
        $image_path = Storage::disk('sector_disk')->putFileAs($model::BASE_PATH, $this->file_image, $image_name);
        
        $insert = $model::create([
            'image_real_name' => $this->file_image->getClientOriginalName(),
            'image_name' => $image_name,
            'tanggal' => $date_now,
        ]);
        
        $this->resetInput();
        
        return $this->dispatchBrowserEvent('notification:show', ['type' => 'success', 'title' => 'Success!', 'message' => 'Successfully adding data.']);
    }
    
    public function setInputTanggal($value)
    {
        $this->input_tanggal = $value;
    }
    
    public function resetInput()
    {
        $this->reset('file_image', 'selected_item');
        $this->input_tanggal = date('d/m/Y');
        $this->iteration++;
    }
    
    public function setItem($id, $type)
    {
        $item = $this->getItemById($id, $type);
        if(!$item) return $this->dispatchBrowserEvent('notification:show', ['type' => 'warning', 'title' => 'Ops!', 'message' => "Sorry we can't find any data"]);
        $this->selected_item = $item->toArray();
        $this->selected_item['type'] = $type;
        $this->selected_url = route('files.image.stream', ['path' => $item->base_path, 'name' => $item->image_name]);
        return $this->dispatchBrowserEvent('wheelzoom:init');
    }
    
    public function getItemById($id, $type)
    {
        $model = null;
        if($type == 'resume') {
            $model = ResumeJurnal::class;
        } elseif($type == 'jurnal') {
            $model = JurnalHarian::class;
        } else {
            return false;
        }
        return $model::findOrFail($id);
    }
    
    public function setGroupName($name)
    {
        $this->selected_group_name = $name;
        $this->control_tabs = [
            'list' => false,
            'detail' => true,
        ];
        return $this->dispatchBrowserEvent('magnific-popup:init', ['target' => '.main-popup-link']);
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
        $item = $this->getItemById($this->selected_item['id'], $this->selected_item['type']);
        if(!$item) return $this->dispatchBrowserEvent('notification:show', ['type' => 'warning', 'title' => 'Ops!', 'message' => "Sorry we can't find any data"]);
        $path = $item->full_path;
        
        return Storage::disk('sector_disk')->download($path, $item->image_real_name);
    }
    
    public function delete($id, $type)
    {
        $item = $this->getItemById($id, $type);
        if(!$item) return $this->dispatchBrowserEvent('notification:show', ['type' => 'warning', 'title' => 'Ops!', 'message' => "Sorry we can't find any data"]);
        $path = $item->full_path;
        Storage::disk('sector_disk')->delete($path);
        $item->delete();
        $this->resetInput();
        return ['status_code' => 200, 'message' => 'Data has been deleted.'];
    }
}
