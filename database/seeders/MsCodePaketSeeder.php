<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MsCodePaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ms_code_pakets')->insert([
            ['id' => 1, 'parent_code_id' => 3, 'code' => '300P1', 'nama' => 'Paket Pengajuan Dana'],
        ]);
    }
}
