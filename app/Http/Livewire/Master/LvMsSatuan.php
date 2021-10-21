<?php

namespace App\Http\Livewire\Master;

use Livewire\Component;
use App\Models\{
    Master\MsSatuan,
};

class LvMsSatuan extends Component
{
    public $satuan;
    public $keterangan;

    public function render()
    {
        $data['ms_satuans'] = MsSatuan::all();

        return view('livewire.master.lv-ms-satuan')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }

    public function addSatuan()
    {
        $this->validate([
            'satuan' => 'required|string',
        ]);

        $insert = MsSatuan::create([
            'satuan' => $this->satuan, 
            'keterangan' => $this->keterangan,
        ]);

        $this->resetInput();
        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => 'Successfully adding data.']);
    }

    public function resetInput()
    {
        $this->reset(['satuan', 'keterangan']);
    }
}
