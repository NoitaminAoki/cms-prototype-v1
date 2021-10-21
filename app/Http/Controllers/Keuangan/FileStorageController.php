<?php

namespace App\Http\Controllers\Keuangan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{
    Keuangan\RealisasiDana,
    Keuangan\ItemJurnalHarian,
    Keuangan\ItemJurnalHarianMasuk,
    Keuangan\Kwitansi,
};

use App\Exports\Keuangan\JurnalHarianAllExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class FileStorageController extends Controller
{
    public function fileRealisasiDana($id)
    {
        $file = RealisasiDana::findOrFail($id);
        $path = storage_path('app/'.$file->bukti_transfer_path);
        
        if (file_exists($path)) {
            
            return response()
            ->file($path, array('Content-Type' =>'image'));
            
        }
        
        abort(404);
    }

    public function exportExcel()
    {
        $filter_data = ['paket_id' => 1];
        $filter_tanggal = "2021-10";
        $filter_tanggal_then = date('Y-m-1 00:00:00', strtotime('-1 months', strtotime($filter_tanggal)));
        $start_date = date('Y-m-1 00:00:00', strtotime($filter_tanggal));
        $end_date = date('Y-m-t 00:00:00', strtotime($filter_tanggal));
        $end_date_then = date('Y-m-t 00:00:00', strtotime($filter_tanggal_then));
        $filter_between['tanggal'] = [$start_date, $end_date];

        $filter_between_then['tanggal'] = [$filter_tanggal_then, $end_date_then];

        // dd($filter_between_then);

        $query_total_1 = ItemJurnalHarianMasuk::query()
        ->selectRaw('SUM(jumlah) as total')
        ->whereBetween('tanggal', $filter_between_then)
        ->pluck('total')
        ->first();

        $query_total_2 = ItemJurnalHarian::query()
        ->selectRaw('SUM(total_harga) as total')
        ->whereBetween('tanggal', $filter_between_then)
        ->pluck('total')
        ->first();

        $query_1 = ItemJurnalHarianMasuk::query()
        ->select('id' , 'sumber as description', 'jumlah as total', 'tanggal')
        ->selectRaw('"masuk" as type');

        $query_2 = ItemJurnalHarian::query()
        ->select('id' , 'nama as description', 'total_harga as total', 'tanggal')
        ->selectRaw('"keluar" as type')
        ->unionAll($query_1)
        ->when($filter_data, function ($query, $filter_data) {
            return $query->where($filter_data);
        });

        $main_query = DB::table(DB::raw(" ({$query_2->toSql()}) as tab"))
        ->mergeBindings($query_2->getQuery())
        ->when($filter_between, function ($query, $filter_data) {
            return $query->whereBetween('tanggal', $filter_data['tanggal']);
        })
        ->select('*')
        ->orderBy('tanggal')
        ->get();

        $data['list_items'] = $main_query;
        $akumulasi_masuk = 0;
        $akumulasi_keluar = 0;
        $saldo = 0;
        if ($filter_tanggal) {
            $akumulasi_masuk = $query_total_1;
            $akumulasi_keluar = $query_total_2;
            $saldo = $akumulasi_masuk - $akumulasi_keluar;
        }
        $data['total'] = ['akumulasi_masuk' => $akumulasi_masuk, 'akumulasi_keluar' => $akumulasi_keluar, 'saldo' => $saldo];
        $data['previous_item'] = ['month' => date('F', strtotime($filter_tanggal_then)), 'total_in' => $akumulasi_masuk, 'total_out' => $akumulasi_keluar];
        $data['jurnal'] = ['divisi' => 'Operasional / Management', 'code' => '210', 'tanggal' => date('F Y', strtotime($filter_tanggal))];
        // dd($data);
        // return view('layouts.excel.keuangan.jurnal-harian-all-export')->with($data);
        return Excel::download(new JurnalHarianAllExport($data), 'jurnal-harian-all.xlsx');
    }
}
