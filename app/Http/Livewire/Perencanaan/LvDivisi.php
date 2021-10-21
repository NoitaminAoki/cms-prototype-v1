<?php

namespace App\Http\Livewire\Perencanaan;

use Livewire\Component;
use App\Models\{
    Perencanaan\Divisi,
};

class LvDivisi extends Component
{
    public function render()
    {
        $data['divisis'] = Divisi::all();

        return view('livewire.perencanaan.lv-divisi')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
}
