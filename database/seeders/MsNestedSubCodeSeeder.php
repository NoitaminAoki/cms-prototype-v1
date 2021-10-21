<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MsNestedSubCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ms_nested_sub_codes')->insert([
            ['id' => 1, 'sub_code_id' => 7, 'code' => 311, 'nama' => 'OPERASIONAL KANTOR'],
            ['id' => 2, 'sub_code_id' => 7, 'code' => 312, 'nama' => 'ALAT TULIS KANTOR'],
            ['id' => 3, 'sub_code_id' => 7, 'code' => 313, 'nama' => 'BIAYA GAJI PEGAWAI'],
            ['id' => 4, 'sub_code_id' => 7, 'code' => 314, 'nama' => 'POS KAS BON PEGAWAI'],
            ['id' => 5, 'sub_code_id' => 7, 'code' => 315, 'nama' => 'BIAYA LAIN - LAIN'],
        ]);

        DB::table('ms_nested_sub_codes')->insert([
            ['id' => 6, 'sub_code_id' => 16, 'code' => 3901, 'nama' => 'MATERIAL URUGAN/TIMBUNAN'],
            ['id' => 7, 'sub_code_id' => 16, 'code' => 3902, 'nama' => 'MATERIAL SEMEN'],
            ['id' => 8, 'sub_code_id' => 16, 'code' => 3903, 'nama' => 'MATERIAL BATA'],
            ['id' => 9, 'sub_code_id' => 16, 'code' => 3904, 'nama' => 'MATERIAL BATU'],
            ['id' => 10, 'sub_code_id' => 16, 'code' => 3905, 'nama' => 'MATERIAL BESI'],
            ['id' => 11, 'sub_code_id' => 16, 'code' => 3906, 'nama' => 'MATERIAL PASIR'],
            ['id' => 12, 'sub_code_id' => 16, 'code' => 3907, 'nama' => 'MATERIAL KUSEN/PINTU'],
            ['id' => 13, 'sub_code_id' => 16, 'code' => 3908, 'nama' => 'MATERIAL LISTRIK'],
            ['id' => 14, 'sub_code_id' => 16, 'code' => 3909, 'nama' => 'MATERIAL CAT'],
            ['id' => 15, 'sub_code_id' => 16, 'code' => 3910, 'nama' => 'MATERIAL KERAMIK'],
            ['id' => 16, 'sub_code_id' => 16, 'code' => 3911, 'nama' => 'MATERIAL ATAP'],
            ['id' => 17, 'sub_code_id' => 16, 'code' => 3912, 'nama' => 'MATERIAL PLAFON'],
            ['id' => 18, 'sub_code_id' => 16, 'code' => 3913, 'nama' => 'MATERIAL SANITER'],
            ['id' => 19, 'sub_code_id' => 16, 'code' => 3914, 'nama' => 'MATERIAL PAVING'],
            ['id' => 20, 'sub_code_id' => 16, 'code' => 3915, 'nama' => 'MATERIAL BATAKO'],
            ['id' => 21, 'sub_code_id' => 16, 'code' => 3916, 'nama' => 'MATERIAL LAINNYA'],
        ]);

        DB::table('ms_nested_sub_codes')->insert([
            ['id' => 22, 'sub_code_id' => 14, 'code' => 3901, 'nama' => 'ALAT BANTU'],
        ]);
    }
}
