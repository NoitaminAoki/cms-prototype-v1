<?php

namespace App\Http\Livewire\Manage\Wilayah;

use Livewire\Component;

class LvFilterData extends Component
{
    public function render()
    {
        $data = [];
        return view('livewire.manage.wilayah.lv-filter-data')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
}
