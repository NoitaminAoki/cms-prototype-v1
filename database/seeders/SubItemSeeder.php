<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_items')->insert([
            ['id' => 1, 'item_id' => 25, 'nama' => 'MATERIAL PONDASI, BETON DAN DINDING', 'has_group' => false],
            ['id' => 2, 'item_id' => 25, 'nama' => 'MATERIAL TIMBUNAN', 'has_group' => false],
            ['id' => 3, 'item_id' => 25, 'nama' => 'MATERIAL ATAP DAN PLAFON', 'has_group' => false],
            ['id' => 4, 'item_id' => 25, 'nama' => 'MATERIAL KUSEN, PINTU & JENDELA', 'has_group' => true],
            ['id' => 5, 'item_id' => 25, 'nama' => 'MATERIAL LANTAI KERAMIK', 'has_group' => false],
            ['id' => 6, 'item_id' => 25, 'nama' => 'MATERIAL LISTRIK', 'has_group' => false],
            ['id' => 7, 'item_id' => 25, 'nama' => 'MATERIAL PENGECATAN', 'has_group' => false],
            ['id' => 8, 'item_id' => 25, 'nama' => 'MATERIAL SANITASI', 'has_group' => false],
            ['id' => 9, 'item_id' => 25, 'nama' => 'MATERIAL ALAT BANTU', 'has_group' => false],
        ]);
    }
}
