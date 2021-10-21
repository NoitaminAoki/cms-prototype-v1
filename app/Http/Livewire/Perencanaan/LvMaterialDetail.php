<?php

namespace App\Http\Livewire\Perencanaan;

use Livewire\Component;
use App\Models\{
    Perencanaan\MaterialDetail,

    Master\MsSatuan,
    Master\MsSubCode,
    Master\MsNestedSubCode,
};

class LvMaterialDetail extends Component
{
    protected $listeners = [
        'evSetCode' => 'setCode',
        'evSetSatuan' => 'setSatuan',
    ];

    public $pos_material_id;
    public $nama_material;
    public  $nested_sub_code_id;
    public  $volume;
    public  $harga_satuan;
    public  $satuan_id;

    public function mount()
    {
        $pos_material = MsSubCode::where('code', 390)->first();
        $this->pos_material_id = $pos_material->id;
    }

    public function render()
    {
        $data['ms_codes'] = MsNestedSubCode::where('sub_code_id', $this->pos_material_id)->get();
        $data['ms_satuans'] = MsSatuan::orderBy('satuan')->get();

        $data['material_details'] = MaterialDetail::all();

        return view('livewire.perencanaan.lv-material-detail')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }

    public function addMaterialDetail()
    {
        $this->validate([
            'nested_sub_code_id' => 'required|integer',
            'satuan_id' => 'required|integer',
            'nama_material' => 'required|string',
            'volume' => 'required|integer',
            'harga_satuan' => 'required|integer',
        ]);

        $insert = MaterialDetail::insert([
            'nama_material' => $this->nama_material,
            'nested_sub_code_id' => $this->nested_sub_code_id,
            'volume' => $this->volume,
            'satuan_id' => $this->satuan_id,
            'harga_satuan' => $this->harga_satuan,
        ]);

        $this->resetInput();

        return $this->dispatchBrowserEvent('notification:success', ['title' => 'Success!', 'message' => 'Successfully adding data.']);
    }

    public function resetInput()
    {
        $this->reset(['nama_material', 'nested_sub_code_id', 'volume', 'satuan_id', 'harga_satuan']);
    }

    public function setCode($code_id)
    {
        $this->nested_sub_code_id = $code_id;
    }

    public function setSatuan($satuan_id)
    {
        $this->satuan_id = $satuan_id;
    }
}
