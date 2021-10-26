<?php

namespace App\Http\Livewire\Perencanaan;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    Perencanaan\GambarUnitRumah,
};

class LvGambarUnitRumah extends Component
{
    use WithFileUploads;

    protected $listeners = [
        'evSetPaket' => 'setPaket',
        'evSetInputTanggal' => 'setInputTanggal',
    ];

    public $page_attribute = [
        'title' => 'Gambar Unit Rumah',
    ];
    public $page_permission = [
        'add' => 'gambar-unit-rumah add',
        'delete' => 'gambar-unit-rumah delete',
    ];

    public $file_pdf;
    public $input_tanggal;
    public $iteration;

    public $selected_item;
    public $selected_url;
    
    public function render()
    {
        $data['items'] = GambarUnitRumah::all();
        return view('livewire.perencanaan.lv-gambar-unit-rumah')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }

    public function addItem()
    {
        $this->validate([
            'file_pdf' => 'required|mimes:pdf',
            'input_tanggal' => 'required|string',
        ]);
        $date_now = date('Y-m-d H:i:s', strtotime($this->input_tanggal));
        $pdf_name = 'pdf_gambar_unit_rumah_'.Date('YmdHis').'.'.$this->file_pdf->extension();
        $pdf_path = Storage::putFileAs('pdf/perencanaan/gambar_unit_rumah', $this->file_pdf, $pdf_name);

        $insert = GambarUnitRumah::create([
            'pdf_name' => $this->file_pdf->getClientOriginalName(),
            'pdf_path' => $pdf_path,
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
        $this->reset('file_pdf', 'selected_item');
        $this->input_tanggal = date('m/d/Y');
        $this->iteration++;
    }

    public function setItem($id)
    {
        $item = GambarUnitRumah::findOrFail($id);
        $this->selected_item = $item;
        $this->selected_url = route('pdf.perencanaan.gambar_unit_rumah', ['id' => $item->id]);
    }

    public function downloadPdf()
    {
        $file = GambarUnitRumah::findOrFail($this->selected_item['id']);
        $path = storage_path('app/'.$file->pdf_path);
        
        return response()->download($path, $file->pdf_name);
    }

    public function delete($id)
    {
        $item = GambarUnitRumah::findOrFail($id);
        Storage::delete($item->pdf_path);
        $item->delete();
        $this->resetInput();
        return ['status_code' => 200, 'message' => 'Data has been deleted.'];
    }
}
