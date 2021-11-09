<?php

namespace App\Http\Livewire\Perencanaan;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    Perencanaan\KonstruksiUnitRumah,
    Perencanaan\ItemUnitRumah,
};
use App\Helpers\StringGenerator;

class LvItemUnitRumah extends Component
{
    use WithFileUploads;

    protected $listeners = [
        'evSetInputTanggal' => 'setInputTanggal',
    ];
    
    public $page_attribute = [
        'title' => '',
    ];
    public $page_permission = [
        'add' => 'item-unit-rumah add',
        'delete' => 'item-unit-rumah delete',
    ];

    public $file_image;
    public $input_tanggal;
    public $iteration;

    public $selected_item;
    public $selected_url;

    public function mount($slug)
    {
        $parent = KonstruksiUnitRumah::query()
        ->where('slug_name', $slug)
        ->firstOrFail();

        $this->parent_id = $parent->id;
        $this->page_attribute['title'] = $parent->type;
    }

    public function render()
    {
        $data['items'] = ItemUnitRumah::query()
        ->where('konstruksi_unit_id', $this->parent_id)
        ->get();

        return view('livewire.perencanaan.lv-item-unit-rumah')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }

    public function addItem()
    {
        $this->validate([
            'file_image' => 'required|image',
            'input_tanggal' => 'required|string',
        ]);
        $date_parse = str_replace('/', '-', $this->input_tanggal);
        $date_now = date('Y-m-d H:i:s', strtotime($date_parse));
        $image_name = StringGenerator::fileName($this->file_image->extension());
        $image_path = Storage::disk('sector_disk')->putFileAs(ItemUnitRumah::BASE_PATH, $this->file_image, $image_name);

        $insert = ItemUnitRumah::create([
            'konstruksi_unit_id' => $this->parent_id,
            'image_real_name' => $this->file_image->getClientOriginalName(),
            'image_name' => $image_name,
            'tanggal' => $date_now,
        ]);

        $this->resetInput();
        
        $this->dispatchBrowserEvent('magnific-popup:init', ['target' => '.main-popup-link']);
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

    public function setItem($id)
    {
        $item = ItemUnitRumah::findOrFail($id);
        $this->selected_item = $item;
        $this->selected_url = route('files.image.stream', ['path' => $item->base_path, 'name' => $item->image_name]);
        return $this->dispatchBrowserEvent('wheelzoom:init');
    }

    public function downloadImage()
    {
        $item = ItemUnitRumah::findOrFail($this->selected_item['id']);
        $path = $item->base_path.$item->image_name;
        
        return Storage::disk('sector_disk')->download($path, $item->image_real_name);
    }

    public function delete($id)
    {
        $item = ItemUnitRumah::findOrFail($id);
        $path = $item->base_path.$item->image_name;
        Storage::disk('sector_disk')->delete($path);
        $item->delete();
        $this->resetInput();
        return ['status_code' => 200, 'message' => 'Data has been deleted.'];
    }
}
