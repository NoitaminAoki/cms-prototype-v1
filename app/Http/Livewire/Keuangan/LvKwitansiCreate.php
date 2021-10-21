<?php

namespace App\Http\Livewire\Keuangan;

use Livewire\Component;
use App\Models\{
    Keuangan\Kwitansi,
    Keuangan\RealisasiDana,
};
use Illuminate\Support\Facades\DB;

class LvKwitansiCreate extends Component
{
    public $list_items = [];
    public $realisasi_ids = [];
    public $total_harga = 0;

    public $penerima_kwitansi;
    public $penanggung_jawab;

    public function mount()
    {   
        $items = RealisasiDana::query()
        ->whereNull('kwitansi_id')
        ->where('status', 'complete')
        ->with(['pengajuan.paket', 'pengajuan.item'])
        ->get();
        
        $this->list_items = $items->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'format_code' => $item->format_code,
                'paket' => $item->pengajuan->paket->nama,
                'item' => $item->pengajuan->item->nama,
                'total_harga' => $item->jumlah,
            ];
        })->toArray();
    }

    public function render()
    {
        $data = [];
        return view('livewire.keuangan.lv-kwitansi-create')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }

    public function addKwitansi()
    {
        DB::beginTransaction();

        
        $realisasi = RealisasiDana::query()
        ->whereIn('id', $this->realisasi_ids);
        
        $sum_realisasi = $realisasi->get()->sum('jumlah');
        
        $kwitansi = Kwitansi::create([
            'penerima' => $this->penerima_kwitansi,
            'penanggung_jawab' => $this->penanggung_jawab,
            'total_jumlah' => $sum_realisasi,
        ]);

        $realisasi->update([
            'kwitansi_id' => $kwitansi->id,
        ]);
        
        DB::commit();        

		\Session::flash('success', "Successfully adding data.");

        return redirect()->route('keuangan.kwitansi.index');
    }
}
