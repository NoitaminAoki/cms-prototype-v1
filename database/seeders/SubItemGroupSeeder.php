<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubItemGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_item_groups')->insert([
            ['id' => 1, 'nama' => 'PEKERJAAN PJ1 (1 unit)'],
            ['id' => 2, 'nama' => 'PEKERJAAN PJ2 (1 unit)'],
            ['id' => 3, 'nama' => 'PEKERJAAN P1 (2 unit)'],
            ['id' => 4, 'nama' => 'PEKERJAAN P2 (1 unit)'],
            ['id' => 5, 'nama' => 'PEKERJAAN J1 (1 unit)'],
            ['id' => 6, 'nama' => 'PEKERJAAN J2 (1 unit)'],
            ['id' => 7, 'nama' => 'PEKERJAAN J3'],
            ['id' => 8, 'nama' => 'PEKERJAAN ROSTER ( ANGIN - ANGIN )'],
            ['id' => 9, 'nama' => 'PERLENGKAPAN PINTU DAN JENDELA'],
        ]);
    }
}
