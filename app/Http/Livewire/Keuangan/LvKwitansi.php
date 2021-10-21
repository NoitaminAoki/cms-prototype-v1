<?php

namespace App\Http\Livewire\Keuangan;

use Livewire\Component;
use App\Models\{
    Keuangan\Kwitansi,
    Keuangan\RealisasiDana,
};

class LvKwitansi extends Component
{
    public $selected_kwitansi;
    public $realisasi_dana_kwitansi = [];

    public $show_modal = false;

    public function render()
    {
        $data['kwitansis'] = Kwitansi::all();

        return view('livewire.keuangan.lv-kwitansi')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }

    public function setKwitansi($id)
    {
        $this->show_modal = true;
        $kwitansi = Kwitansi::findOrFail($id);

        $items = RealisasiDana::query()
        ->where(['status' => 'complete', 'kwitansi_id' => $id])
        ->with(['pengajuan.paket', 'pengajuan.item'])
        ->get();

        $this->selected_kwitansi = $kwitansi;
        $this->realisasi_dana_kwitansi = $items;

    }
}
