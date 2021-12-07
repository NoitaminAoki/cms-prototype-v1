<?php

namespace App\Http\Livewire\Tester;

use Livewire\Component;

class LvFileChunk extends Component
{
    public $page_attribute = [
        'title' => 'Brosur Perumahan',
    ];
    public $page_permission = [
        'add' => 'brosur-perumahan add',
        'delete' => 'brosur-perumahan delete',
    ];

    public $file_image;
    public $input_tanggal;
    public $iteration;

    public function render()
    {
        return view('livewire.tester.lv-file-chunk')
        ->with([])
        ->layout('layouts.dashboard.main');
    }
}
