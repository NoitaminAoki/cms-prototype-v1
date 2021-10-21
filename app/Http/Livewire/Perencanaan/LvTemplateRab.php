<?php

namespace App\Http\Livewire\Perencanaan;

use Livewire\Component;
use App\Models\{
    Master\MsKonstruksiDivisi,
};

class LvTemplateRab extends Component
{
    public function render()
    {
        $data['konstruksi_divisis'] = MsKonstruksiDivisi::all();

        return view('livewire.perencanaan.lv-template-rab')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
}
