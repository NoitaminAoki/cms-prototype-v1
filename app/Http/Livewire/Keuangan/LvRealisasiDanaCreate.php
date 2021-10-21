<?php

namespace App\Http\Livewire\Keuangan;

use Livewire\Component;
use App\Models\{
    Perencanaan\MaterialDetail,

    Keuangan\PengajuanDana,
    Keuangan\MaterialPengajuanDana,
    Keuangan\RealisasiDana,
    Keuangan\MaterialRealisasiDana,
};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LvRealisasiDanaCreate extends Component
{
    public $pengajuan_dana_id;
    public $list_items = [];
    public $total_harga_material = 0;

    public $keterangan_realisasi;
    public $asal_realisasi;

    
    public function mount($pengajuan_dana_id)
    {
        $this->pengajuan_dana_id = $pengajuan_dana_id;
        
        $items = MaterialPengajuanDana::query()
        ->where('pengajuan_dana_id', $pengajuan_dana_id)
        ->with('material.ms_satuan')
        ->get();
        
        $this->list_items = $items->map(function ($item, $key) {
            return [
                'id' => $item->id,
                'material_id' => $item->material_detail_id,
                'nama_material' => $item->material->nama_material,
                'satuan' => $item->material->ms_satuan->satuan,
                'harga_satuan' => $item->harga_satuan,
                'stock' => $item->material->volume,
                'jumlah_awal' => $item->jumlah,
                'jumlah_akhir' => $item->jumlah,
                'jumlah_terkurang' => 0,
                'total_harga' => $item->total_harga,
                'is_deleted' => false,
            ];
        })->toArray();
    }

    public function updatedListItems($value, $newValue)
    {
        $index = Str::remove('.jumlah_akhir', $newValue);
        $item = $this->list_items[$index];
        if($value <= 0) {
            $item['jumlah_akhir'] = 1;
        } else if($value > $item['jumlah_awal']) {
            $item['jumlah_akhir'] = $item['jumlah_awal'];
        }
        $item['jumlah_terkurang'] = $item['jumlah_awal'] - $item['jumlah_akhir'];
        $item['total_harga'] = $item['harga_satuan'] * $item['jumlah_akhir'];

        $this->list_items[$index] = $item;
    }
    
    public function render()
    {
        $data['pengajuan_dana'] = PengajuanDana::findOrFail($this->pengajuan_dana_id);
        
        return view('livewire.keuangan.lv-realisasi-dana-create')
        ->with($data)
        ->layout('layouts.dashboard.main');
    }

    public function toggleDeleteMaterial($index)
    {
        $this->list_items[$index]['is_deleted'] = !$this->list_items[$index]['is_deleted'];
    }

    public function addRealisasiDana()
    {
        // dd($this->list_items);
        DB::beginTransaction();
        $pengajuan_dana = PengajuanDana::findOrFail($this->pengajuan_dana_id);
        $pengajuan_dana->status_pengajuan = 'process';
        $pengajuan_dana->save();
        $total_harga = 0;

        $data_insert = [];
        $deleted_ids = [];


        $realisasi_dana = RealisasiDana::create([
            'pengajuan_dana_id' => $pengajuan_dana->id,
            'divisi_id' => $pengajuan_dana->divisi_id,
            'asal' => $this->asal_realisasi,
            'keterangan' => $this->keterangan_realisasi,
            'jumlah' => $total_harga,
            'status' => 'process',

        ]);

        foreach ($this->list_items as $key => $item) {
            if(!$item['is_deleted']) {
                if ($item['jumlah_akhir'] > $item['stock']) {
                    $item['jumlah_akhir'] = $item['stock'];
                    $item['jumlah_terkurang'] = $item['jumlah_akhir'] - $item['stock'];
                }

                $sub_total_harga = $item['jumlah_akhir']*$item['harga_satuan'];
                $total_harga += $sub_total_harga;
                $update_material_pengajuan = MaterialPengajuanDana::query()
                ->where('id', $item['id'])
                ->first();

                if ($item['jumlah_akhir'] == 0) {
                    $update_material_pengajuan->delete();
                } else {
                    $update_material_pengajuan->jumlah = $item['jumlah_akhir'];
                    $update_material_pengajuan->total_harga = $sub_total_harga;
                    $update_material_pengajuan->save();
                }
                

                $update_material_stock = MaterialDetail::find($item['material_id'])
                ->decrement('volume', $item['jumlah_akhir']);


                if($item['jumlah_terkurang'] > 0) {
                    $data_insert[] = [
                        'realisasi_dana_id' => $realisasi_dana->id,
                        'material_pengajuan_dana_id' => $item['id'],
                        'material_detail_id' => $item['material_id'],
                        'jumlah' => $item['jumlah_terkurang'],
                        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    ];
                }
            } else {
                $deleted_ids[] = $item['id'];
            }
        }

        $insert_material_realisasi = MaterialRealisasiDana::insert($data_insert);

        $deleted_material = MaterialPengajuanDana::destroy($deleted_ids);
        $realisasi_dana->jumlah = $total_harga;
        $realisasi_dana->save();
        DB::commit();
        
		\Session::flash('success', "Successfully adding data.");

        return redirect()->route('keuangan.realisasi_dana.index');
    }
}
