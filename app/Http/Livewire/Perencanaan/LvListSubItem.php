<?php

namespace App\Http\Livewire\Perencanaan;

use Livewire\Component;
use App\Models\{
    Perencanaan\SubItem,
};
use App\Helpers\Converter;

class LvListSubItem extends Component
{
    public function render()
    {
        $data['sub_items'] = SubItem::where('item_id', 1)->get();
        $data['converter_class'] = Converter::class;
        return view('livewire.perencanaan.lv-list-sub-item')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
}
