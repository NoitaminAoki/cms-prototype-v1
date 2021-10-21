<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\{
    Keuangan\KasBesar,
};

class LvDashboard extends Component
{
    public function render()
    {
        $data['kasbesar'] = KasBesar::sum('jumlah');
        return view('livewire.dashboard.lv-dashboard')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
}
