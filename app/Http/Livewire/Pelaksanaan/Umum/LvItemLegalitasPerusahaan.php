<?php

namespace App\Http\Livewire\Pelaksanaan\Umum;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    Umum\LegalitasPerusahaan,
    Umum\ItemLegalitasPerusahaan,
};
use App\Helpers\StringGenerator;

class LvItemLegalitasPerusahaan extends Component
{
    use WithFileUploads;

    protected $listeners = [
        'evSetInputTanggal' => 'setInputTanggal',
    ];
    
    public $page_attribute = [
        'title' => '',
    ];
    public $page_permission = [
        'add' => 'item-legalitas-perusahaan add',
        'delete' => 'item-legalitas-perusahaan delete',
    ];

    public $parent_id;
    public $file_image;
    public $input_tanggal;
    public $iteration;

    public $selected_item;
    public $selected_url;

    public function mount($slug)
    {
        $parent = LegalitasPerusahaan::query()
        ->where('slug_name', $slug)
        ->firstOrFail();

        $this->parent_id = $parent->id;
        $this->page_attribute['title'] = $parent->name;
    }

    public function render()
    {
        $data['items'] = ItemLegalitasPerusahaan::query()
        ->where('legalitas_perusahaan_id', $this->parent_id)
        ->get();

        return view('livewire.pelaksanaan.umum.lv-item-legalitas-perusahaan')
        ->with($data)
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
        $image_path = Storage::disk('sector_disk')->putFileAs(ItemLegalitasPerusahaan::BASE_PATH, $this->file_image, $image_name);

        $insert = ItemLegalitasPerusahaan::create([
            'legalitas_perusahaan_id' => $this->parent_id,
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
        $item = ItemLegalitasPerusahaan::findOrFail($id);
        $this->selected_item = $item;
        $this->selected_url = route('files.image.stream', ['path' => $item->base_path, 'name' => $item->image_name]);
    }

    public function downloadImage($image_number = 1)
    {
        $file = ItemLegalitasPerusahaan::findOrFail($this->selected_item['id']);
        $path = $item->base_path.$item->image_name;
        
        return Storage::disk('sector_disk')->download($path, $item->image_real_name);
    }

    public function delete($id)
    {
        $item = ItemLegalitasPerusahaan::findOrFail($id);
        $path = $item->base_path.$item->image_name;
        Storage::disk('sector_disk')->delete($path);
        $item->delete();
        $this->resetInput();
        return ['status_code' => 200, 'message' => 'Data has been deleted.'];
    }
}
