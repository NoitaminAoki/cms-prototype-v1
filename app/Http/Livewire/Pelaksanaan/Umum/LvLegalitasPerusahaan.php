<?php

namespace App\Http\Livewire\Pelaksanaan\Umum;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    Umum\LegalitasPerusahaan,
};

class LvLegalitasPerusahaan extends Component
{
    use WithFileUploads;

    protected $listeners = [
        'evSetPaket' => 'setPaket',
        'evSetInputTanggal' => 'setInputTanggal',
    ];

    public $page_attribute = [
        'title' => 'Legalitas Perusahaan',
    ];
    public $page_permission = [
        'add' => 'legalitas-perusahaan add',
        'delete' => 'legalitas-perusahaan delete',
    ];

    public $route_image_item = "image.umum.legalitas_perusahaan";

    public $paket_id;
    public $file_image;
    public $input_tanggal;
    public $iteration;

    public $selected_item;
    public $selected_url;
    
    public function render()
    {
        $data['items'] = LegalitasPerusahaan::all();
        return view('livewire.pelaksanaan.umum.lv-legalitas-perusahaan')
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
        $image_name = 'image_legalitas_perusahaan_'.Date('YmdHis').'.'.$this->file_image->extension();
        $image_path = Storage::putFileAs('images/umum/legalitas_perusahaan/', $this->file_image, $image_name);

        $insert = LegalitasPerusahaan::create([
            'image_name' => $this->file_image->getClientOriginalName(),
            'image_path' => $image_path,
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
        $input_tanggal = date('m/d/Y');
        $this->iteration++;
    }

    public function setItem($id)
    {
        $resume = LegalitasPerusahaan::findOrFail($id);
        $this->selected_item = $resume;
        $this->selected_url = route('image.umum.legalitas_perusahaan', ['id' => $resume->id]);
    }

    public function downloadImage()
    {
        $file = LegalitasPerusahaan::findOrFail($this->selected_item['id']);
        $path = storage_path('app/'.$file->image_path);
        
        return response()->download($path, $file->image_name);
    }

    public function delete($id)
    {
        $item = LegalitasPerusahaan::findOrFail($id);
        Storage::delete($item->image_path);
        $item->delete();
        return ['status_code' => 200, 'message' => 'Data has been deleted.'];
    }
}
