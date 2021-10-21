<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MsKontruksiDivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ms_konstruksi_divisis')->insert([
            [
                'id' => 1,
                'nama' => 'Biaya Pengadaan Lahan',
                'has_template_view' => true,
                'total_harga' => 8630619560,
            ],
            [
                'id' => 2,
                'nama' => 'Biaya Perijinan & Legalitas',
                'has_template_view' => false,
                'total_harga' => 1537401600,
            ],
            [
                'id' => 3,
                'nama' => 'Konstruksi Proyek',
                'has_template_view' => false,
                'total_harga' => 27567521499,
            ],
            [
                'id' => 4,
                'nama' => 'Marketing & Promosi',
                'has_template_view' => false,
                'total_harga' => 2016110625,
            ],
            [
                'id' => 5,
                'nama' => 'Biaya Operasional',
                'has_template_view' => false,
                'total_harga' => 1505246155,
            ],
            [
                'id' => 6,
                'nama' => 'Pajak',
                'has_template_view' => false,
                'total_harga' => 1784073750,
            ],
        ]);
    }
}
