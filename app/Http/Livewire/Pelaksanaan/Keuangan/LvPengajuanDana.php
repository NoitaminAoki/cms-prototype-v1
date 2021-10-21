<?php

namespace App\Http\Livewire\Pelaksanaan\Keuangan;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\{
    Keuangan\PengajuanDana,

    Master\MsSubCode,
};

class LvPengajuanDana extends Component
{
    use WithFileUploads;

    protected $listeners = [
        'evSetPaket' => 'setPaket',
        'evSetInputTanggal' => 'setInputTanggal',
    ];

    public $paket_id;
    public $file_excel;
    public $file_image;
    public $input_tanggal;
    public $iteration;

    public $selected_pengajuan;
    public $selected_url;
    
    public function render()
    {
        $data['pakets'] = MsSubCode::all();

        $data['pengajuan_danas'] = PengajuanDana::all();
        return view('livewire.pelaksanaan.keuangan.lv-pengajuan-dana')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }

    public function setPaket($value)
    {
        $this->paket_id = $value;
    }

    public function addPengajuanDana()
    {
        $this->validate([
            'paket_id' => 'required|integer',
            'file_image' => 'required|image',
            'file_excel' => 'required',
            'input_tanggal' => 'required|string',
        ]);
        $date_now = date('Y-m-d H:i:s', strtotime($this->input_tanggal));
        $image_name = 'image_pengajuan_dana_'.Date('YmdHis').'.'.$this->file_image->extension();
        $image_path = Storage::putFileAs('images/keuangan/pengajuan_dana/', $this->file_image, $image_name);

        $excel_name = 'excel_pengajuan_dana_'.Date('YmdHis').'.'.$this->file_excel->extension();
        $excel_path = Storage::putFileAs('files/keuangan/pengajuan_dana/', $this->file_excel, $excel_name);

        $insert = PengajuanDana::create([
            'paket_id' => $this->paket_id,
            'image_name' => $this->file_image->getClientOriginalName(),
            'image_path' => $image_path,
            'excel_name' => $this->file_excel->getClientOriginalName(),
            'excel_path' => $excel_path,
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
        $this->reset('paket_id', 'file_image', 'file_excel', 'selected_pengajuan');
        $input_tanggal = date('m/d/Y');
        $this->iteration++;
    }

    public function setPengajuanDana($id)
    {
        $pengajuan = PengajuanDana::findOrFail($id);
        $this->selected_pengajuan = $pengajuan;
        $this->selected_url = route('image.keuangan.pengajuan_dana', ['id' => $pengajuan->id]);
    }

    public function downloadImage()
    {
        $file = PengajuanDana::findOrFail($this->selected_pengajuan['id']);
        $path = storage_path('app/'.$file->image_path);
        
        return response()->download($path, $file->image_name);
    }
}
