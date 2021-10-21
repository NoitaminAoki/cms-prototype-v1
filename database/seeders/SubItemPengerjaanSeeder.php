<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubItemPengerjaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_item_pengerjaans')->insert([
            ['id' => 1, 'item_id' => 25, 'nama' => 'PEKERJAAN PENDAHULUAN', 'has_group' => false],
            ['id' => 2, 'item_id' => 25, 'nama' => 'PEKERJAAN TANAH DAN URUGAN', 'has_group' => false],
            ['id' => 3, 'item_id' => 25, 'nama' => 'PEKERJAAN PONDASI', 'has_group' => false],
            ['id' => 4, 'item_id' => 25, 'nama' => 'PEKERJAAN BETON', 'has_group' => false],
            ['id' => 5, 'item_id' => 25, 'nama' => 'PEKERJAAN DINDING (BATA RINGAN)', 'has_group' => false],
            ['id' => 6, 'item_id' => 25, 'nama' => 'PEKERJAAN BETON MEJA DAPUR', 'has_group' => false],
            ['id' => 7, 'item_id' => 25, 'nama' => 'PEKERJAAN ATAP', 'has_group' => false],
            ['id' => 8, 'item_id' => 25, 'nama' => 'PEKERJAAN PLAFON', 'has_group' => false],
            ['id' => 9, 'item_id' => 25, 'nama' => 'PEMASANGAN KUSEN, PINTU & JENDELA', 'has_group' => false],
            ['id' => 10, 'item_id' => 25, 'nama' => 'PEKERJAAN LANTAI DAN KERAMIK', 'has_group' => false],
            ['id' => 11, 'item_id' => 25, 'nama' => 'PEKERJAAN LANTAI CAR PORT', 'has_group' => false],
            ['id' => 12, 'item_id' => 25, 'nama' => 'PEKERJAAN INSTALASI LISTRIK', 'has_group' => false],
            ['id' => 13, 'item_id' => 25, 'nama' => 'PEKERJAAN PENGECATAN', 'has_group' => false],
            ['id' => 14, 'item_id' => 25, 'nama' => 'PEKERJAAN SANITASI', 'has_group' => false],
            
        ]);
    }
}
