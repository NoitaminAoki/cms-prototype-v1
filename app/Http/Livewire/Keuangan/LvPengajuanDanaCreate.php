<?php

namespace App\Http\Livewire\Keuangan;

use Livewire\Component;
use App\Helpers\Converter;
use App\Models\{
    Master\MsCode,
    Master\MsCodePaket,
    Master\MsSubCode,
    Master\MsSubDivisiItem,

    Perencanaan\MaterialDetail,

    Keuangan\PengajuanDana,
    Keuangan\MaterialPengajuanDana,
};
use Illuminate\Support\Facades\DB;

class LvPengajuanDanaCreate extends Component
{
    protected $listeners = [
        'evSetItem' => 'setItem',
    ];

    public $divisi_id;
    public $paket_code_id;

    public $selected_paket_id;
    public $selected_item_id;
    public $item_list = [];

    public $total_material_page;
	public $material_page = 1;
	public $offset_material = 0;
	public $limit_material = 0;
    public $material_search;
    public $material_ids = [];
    public $total_harga_material = 0;

    public $keterangan_pengajuan;
    public $pembuat_pengajuan;


    public function mount()
    {
        $this->divisi_id = MsCode::where('code', 300)->firstOrFail()->id;
        $this->paket_code_id = MsCodePaket::select('id')->where(['parent_code_id' => $this->divisi_id, 'code' => '300P1'])->firstOrFail()->id;
        
		$this->limit_material = 15;
    }
    
    public function updatedMaterialSearch($value)
    {
		$this->material_page = 1;
    }

    public function render()
    {
        $data['pakets'] = MsSubCode::select('ms_sub_codes.*', 'ksd.id as sub_divisi_id')
        ->leftJoin('ms_konstruksi_sub_divisis as ksd', 'ksd.sub_code_id', 'ms_sub_codes.id')
        ->where(['ms_sub_codes.parent_code_id' => $this->divisi_id, 'ms_sub_codes.paket_code_id' => $this->paket_code_id])
        ->get();
        
        $query_material = MaterialDetail::when($this->material_search, function ($query, $material_search)
		{
			return $query->where('nama_material', 'like', '%'.$material_search.'%');
		});

        $limit = $this->limit_material;
		$total_data = $query_material->count();
		$total_page = Converter::totalPage($total_data, $limit);
		$this->total_material_page = $total_page;
        $this->offset_material = Converter::pageToOffset($this->material_page, $limit);
		$data['material_details'] = $query_material->when($this->offset_material, function ($query, $offset) use ($limit)
		{
			return $query->offset($offset);
		})
		->limit($limit)->get();

        return view('livewire.keuangan.lv-pengajuan-dana-create')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }
    
	public function changePaket($json_data)
	{
        $value = json_decode($json_data);
		$this->selected_paket_id = $value->id;
		if(!$value->sub_divisi_id) {
			$this->selected_paket_id = "";
		}
		$items = MsSubDivisiItem::select('id', 'nama as text')
        ->where('sub_divisi_id', $value->sub_divisi_id)
		->get();
		return $this->dispatchBrowserEvent('select2:change', ['id' => '#select_item', 'data' => $items, 'placeholder' => 'Pilih Item', 'text_empty' => "Pilih Paket Terlebih Dahulu"]);
	}

	public function goToPage($page)
	{
		if($page < 1) {
			$page = 1;
		}
		$this->material_page = $page;
	}

    public function addMaterialToList()
    {
        $previous_items = collect($this->item_list);
        $this->item_list = MaterialDetail::select('id', 'nama_material', 'harga_satuan')
        ->selectRaw('1 as jumlah')
        ->whereIn('id', $this->material_ids)
        ->get()
        ->toArray();

        $collection_items = collect($this->item_list);

        $this->item_list = $collection_items->map(function ($item, $key) use($previous_items)
        {
            $recent = $previous_items->where('id', $item['id'])->first();
            if($recent) {
                return $recent;
            }
                return $item;
        });

        return $this->dispatchBrowserEvent('modal:close');
    }

    public function addPengajuanDana()
    {
        DB::beginTransaction();
        $total_harga = 0;

        $pengajuan_dana = PengajuanDana::create([
            'divisi_id' => $this->divisi_id,
            'paket_id' => $this->selected_paket_id, 
            'sub_divisi_item_id' => $this->selected_item_id,
            'keterangan' => $this->keterangan_pengajuan,
            'pembuat_pengajuan' => $this->pembuat_pengajuan,
            'total_harga_material' => $this->total_harga_material,
            'status_pengajuan' => 'pending',
        ]);

        $collection_items = collect($this->item_list);
        $data_insert = $collection_items->map(function ($item, $key) use($pengajuan_dana, &$total_harga)
        {
            $total_harga += $item['harga_satuan']*$item['jumlah'];

            return [
                'pengajuan_dana_id' => $pengajuan_dana->id, 
                'material_detail_id' => $item['id'], 
                'harga_satuan' => $item['harga_satuan'],
                'jumlah' => $item['jumlah'],
                'total_harga' => $item['harga_satuan']*$item['jumlah'],
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            ];
        });
        
        $pengajuan_dana->total_harga_material = $total_harga;
        $pengajuan_dana->save();
        $insert_items = MaterialPengajuanDana::insert($data_insert->toArray());

        DB::commit();
        
		\Session::flash('success', "Successfully adding data.");

        return redirect()->route('keuangan.pengajuan_dana.index');
    }

    public function setItem($id)
    {
        $this->selected_item_id = $id;
    }
}
