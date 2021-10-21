<?php

namespace App\Http\Livewire\Keuangan;

use Livewire\Component;
use App\Models\{
    Keuangan\JurnalHarian,
    Keuangan\ItemJurnalHarian,

    Master\MsSubCode,
};

class LvJurnalHarianCreate extends Component
{
    protected $listeners = [
        'evSetTanggal' => 'setTanggal',
        'evSetPaket' => 'setPaket',
    ];

    public $paket_id;
    public $tanggal_jurnal;

    public function render()
    {
        $data['pakets'] = MsSubCode::all();

        return view('livewire.keuangan.lv-jurnal-harian-create')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }

    public function setTanggal($value)
    {
        $this->tanggal_jurnal = $value;
    }
    
    public function setPaket($value)
    {
        $this->paket_id = $value;
    }
}
