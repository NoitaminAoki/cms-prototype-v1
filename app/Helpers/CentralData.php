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
                'jurnal_harians',
                'pengajuan_danas',
                'progress_keuangans',
                'realisasi_danas',
                'resume_jurnals',
            ],
            'Konstruksi' => [
                'control_stocks',
                'item_progress_kemajuans',
                'laporan_harians',
                'perjanjian_kontraks',
                'photo_kegiatans',
                'resume_kegiatans',
            ],
            'Marketing' => [
                'item_marketing',
            ],
            'Umum' => [
                'item_aset_perusahaans',
                'inventori_perusahaans',
                'item_legalitas_perusahaans',
                'laporan_kegiatans',
                'sdm_perusahaans',
            ],
        ],
    ];

    public static function getAllTableByDivision($division_name)
    {
        return self::$table_datas['Division'][$division_name] ?? [];
    }
    
}