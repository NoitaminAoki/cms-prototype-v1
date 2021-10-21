<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MsSatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ms_satuans')->insert([
            ['id' => 1, 'satuan' => 'm'],
            ['id' => 2, 'satuan' => 'm²'],
            ['id' => 3, 'satuan' => 'm³'],
            ['id' => 4, 'satuan' => 'Ls'],
            ['id' => 5, 'satuan' => 'Kg'],
            ['id' => 6, 'satuan' => 'Pcs'],
            ['id' => 7, 'satuan' => 'Unit'],
            ['id' => 8, 'satuan' => 'Set'],
            ['id' => 9, 'satuan' => 'Ttk'],
            ['id' => 10, 'satuan' => '40 Kg/Zak'],
            ['id' => 11, 'satuan' => '50 Kg/Zak'],
            ['id' => 12, 'satuan' => 'Btng'],
            ['id' => 13, 'satuan' => 'Lbr'],
            ['id' => 14, 'satuan' => 'Lmbr'],
            ['id' => 15, 'satuan' => 'Dus'],
            ['id' => 16, 'satuan' => 'Liter'],
            ['id' => 17, 'satuan' => 'Kaleng'],
            ['id' => 18, 'satuan' => 'Lainnya'],
            ['id' => 19, 'satuan' => 'Lokasi'],
            ['id' => 20, 'satuan' => 'ml'],
        ]);
    }
}
