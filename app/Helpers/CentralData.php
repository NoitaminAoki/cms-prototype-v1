<?php

namespace App\Helpers;

class CentralData
{
    private static $db_name;
    private static $table_datas = [
        'Perencanaan' => [
            'brosur_perumahaans',
            'financial_analyses',
            'gambar_unit_rumahs',
            'item_konstruksi_saranas',
            'item_unit_rumahs',
        ],
        'Division' => [
            'Keuangan' => [
                ['id' => 'K-JH', 'model' => 'App\Models\Keuangan\JurnalHarian', 'menu_name' => 'Jurnal Harian', 'table_name' => 'jurnal_harians'],
                ['id' => 'K-PD', 'model' => 'App\Models\Keuangan\PengajuanDana', 'menu_name' => 'Pengajuan Dana', 'table_name' => 'pengajuan_danas'],
                ['id' => 'K-PK', 'model' => 'App\Models\Keuangan\ProgressKeuangan', 'menu_name' => 'Progress Keuangan', 'table_name' => 'progress_keuangans'],
                ['id' => 'K-RD', 'model' => 'App\Models\Keuangan\RealisasiDana', 'menu_name' => 'Realisasi Dana', 'table_name' => 'realisasi_danas'],
                ['id' => 'K-RJ', 'model' => 'App\Models\Keuangan\ResumeJurnal', 'menu_name' => 'Resume Jurnal', 'table_name' => 'resume_jurnals'],
            ],
            'Konstruksi' => [
                ['id' => 'C-CS', 'model' => 'App\Models\Konstruksi\ControlStock', 'menu_name' => 'Control Stock', 'table_name' => 'control_stocks'],
                ['id' => 'C-PRK', 'model' => 'App\Models\Konstruksi\ItemProgressKemajuan', 'menu_name' => 'Progress Kemajuan', 'table_name' => 'item_progress_kemajuans'],
                ['id' => 'C-LH', 'model' => 'App\Models\Konstruksi\LaporanHarian', 'menu_name' => 'Laporan Harian', 'table_name' => 'laporan_harians'],
                ['id' => 'C-PJK', 'model' => 'App\Models\Konstruksi\PerjanjianKontrak', 'menu_name' => 'Perjanjian Kontrak', 'table_name' => 'perjanjian_kontraks'],
                ['id' => 'C-PHK', 'model' => 'App\Models\Konstruksi\PhotoKegiatan', 'menu_name' => 'Photo Kegiatan', 'table_name' => 'photo_kegiatans'],
                ['id' => 'C-RK', 'model' => 'App\Models\Konstruksi\ResumeKegiatan', 'menu_name' => 'Resume Kegiatan', 'table_name' => 'resume_kegiatans'],
            ],
            'Marketing' => [
                ['id' => 'M-IM', 'model' => 'App\Models\Marketing\ItemMarketing', 'menu_name' => 'Marketing', 'table_name' => 'item_marketings'],
            ],
            'Umum' => [
                ['id' => 'U-AP', 'model' => 'App\Models\Umum\ItemAsetPerusahaan', 'menu_name' => 'Aset Perusahaan', 'table_name' => 'item_aset_perusahaans'],
                ['id' => 'U-IP', 'model' => 'App\Models\Umum\InventoriPerusahaan', 'menu_name' => 'Inventori Perusahaan', 'table_name' => 'inventori_perusahaans'],
                ['id' => 'U-LP', 'model' => 'App\Models\Umum\ItemLegalitasPerusahaan', 'menu_name' => 'Legalitas Perusahaan', 'table_name' => 'item_legalitas_perusahaans'],
                ['id' => 'U-LK', 'model' => 'App\Models\Umum\LaporanKegiatan', 'menu_name' => 'Laporan Kegiatan', 'table_name' => 'laporan_kegiatans'],
                ['id' => 'U-SP', 'model' => 'App\Models\Umum\SdmPerusahaan', 'menu_name' => 'SDM Perusahaan', 'table_name' => 'sdm_perusahaans'],
            ],
        ],
    ];

    public static function getAllTableByDivision($division_name)
    {
        return self::$table_datas['Division'][$division_name] ?? [];
    }

    public static function getDivisionTableById($division_name, $id)
    {
        $datas = self::$table_datas['Division'][$division_name];
        $item = collect($datas)->where('id', $id)->first();
        return $item;
    }
    
}