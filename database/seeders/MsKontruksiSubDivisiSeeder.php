<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MsKontruksiSubDivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ms_konstruksi_sub_divisis')->insert([
            [
                'id' => 1,
                'konstruksi_divisi_id' => 1,
                'sub_code_id' => null,
                'satuan_id' => 2,
                'nama' => 'Lahan - Area Perumahan',
                'jumlah' => 33716,
                'harga' => 238000,
                'total_harga' => 8023810000,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 2,
                'konstruksi_divisi_id' => 1,
                'sub_code_id' => null,
                'satuan_id' => 2,
                'nama' => 'Biaya PPAT ( 1 % x Harga Jual )',
                'jumlah' => 33716,
                'harga' => 1,
                'total_harga' => 8023810,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 3,
                'konstruksi_divisi_id' => 1,
                'sub_code_id' => null,
                'satuan_id' => 2,
                'nama' => 'SSP Pph ( Final ) ( 5 % ) x Njop ( Rp. - )',
                'jumlah' => 33716,
                'harga' => 1,
                'total_harga' => 200595250,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 4,
                'konstruksi_divisi_id' => 1,
                'sub_code_id' => null,
                'satuan_id' => 4,
                'nama' => 'BPHTB ( Harga - 60 Jt. ) x 5%',
                'jumlah' => 1,
                'harga' => 389190500,
                'total_harga' => 389190500,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],

            [
                'id' => 5,
                'konstruksi_divisi_id' => 2,
                'sub_code_id' => null,
                'satuan_id' => 2,
                'nama' => 'Ijin - ijin Awal Perumahan',
                'jumlah' => null,
                'harga' => null,
                'total_harga' => 2576143750,
                'has_child' => true,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 6,
                'konstruksi_divisi_id' => 2,
                'sub_code_id' => null,
                'satuan_id' => 2,
                'nama' => 'Pertimbangan Teknis ( Pertek )',
                'jumlah' => null,
                'harga' => null,
                'total_harga' => 25287000,
                'has_child' => true,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 7,
                'konstruksi_divisi_id' => 2,
                'sub_code_id' => null,
                'satuan_id' => 2,
                'nama' => 'Pengesahan SITE PLAN',
                'jumlah' => 33716,
                'harga' => 500,
                'total_harga' => 16858000,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 8,
                'konstruksi_divisi_id' => 2,
                'sub_code_id' => null,
                'satuan_id' => 2,
                'nama' => 'IZIN LOKASI',
                'jumlah' => 33716,
                'harga' => 2500,
                'total_harga' => 84290000,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 9,
                'konstruksi_divisi_id' => 2,
                'sub_code_id' => null,
                'satuan_id' => 2,
                'nama' => 'Pengukuran SKPT',
                'jumlah' => 33716,
                'harga' => 500,
                'total_harga' => 16858000,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 10,
                'konstruksi_divisi_id' => 2,
                'sub_code_id' => null,
                'satuan_id' => 7,
                'nama' => 'Sertifikat Induk',
                'jumlah' => 33716,
                'harga' => 10000,
                'total_harga' => 337160000,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 11,
                'konstruksi_divisi_id' => 2,
                'sub_code_id' => null,
                'satuan_id' => 7,
                'nama' => 'Splitsing / Pemecahan Sertipikat',
                'jumlah' => 218,
                'harga' => 2000000,
                'total_harga' => 436000000,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 12,
                'konstruksi_divisi_id' => 2,
                'sub_code_id' => null,
                'satuan_id' => 2,
                'nama' => 'Kontribusi Lingkungan',
                'jumlah' => 33716,
                'harga' => 250,
                'total_harga' => 8429000,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 13,
                'konstruksi_divisi_id' => 2,
                'sub_code_id' => null,
                'satuan_id' => null,
                'nama' => 'IMB Rumah Tinggal',
                'jumlah' => null,
                'harga' => null,
                'total_harga' => 508000000,
                'has_child' => true,
                'is_option' => true,
                'is_percentage' => false,
            ],
            [
                'id' => 14,
                'konstruksi_divisi_id' => 3,
                'sub_code_id' => 8,
                'satuan_id' => null,
                'nama' => 'Perencanaan Proyek',
                'jumlah' => null,
                'harga' => null,
                'total_harga' => 34552539,
                'has_child' => true,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 15,
                'konstruksi_divisi_id' => 3,
                'sub_code_id' => 9,
                'satuan_id' => null,
                'nama' => 'Infrastruktur Proyek',
                'jumlah' => null,
                'harga' => null,
                'total_harga' => 3975392921,
                'has_child' => true,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 16,
                'konstruksi_divisi_id' => 3,
                'sub_code_id' => 10,
                'satuan_id' => null,
                'nama' => 'Struktur Bangunan Unit Rumah',
                'jumlah' => null,
                'harga' => null,
                'total_harga' => 21589200000,
                'has_child' => true,
                'is_option' => true,
                'is_percentage' => false,
            ],
            [
                'id' => 17,
                'konstruksi_divisi_id' => 3,
                'sub_code_id' => 12,
                'satuan_id' => null,
                'nama' => 'Pekerjaan Utilitas & Jaringan',
                'jumlah' => null,
                'harga' => null,
                'total_harga' => 1000662620,
                'has_child' => true,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 18,
                'konstruksi_divisi_id' => 3,
                'sub_code_id' => 13,
                'satuan_id' => null,
                'nama' => 'Fasilitas Umum / Sosial',
                'jumlah' => null,
                'harga' => null,
                'total_harga' => 967713420,
                'has_child' => true,
                'is_option' => false,
                'is_percentage' => false,
            ],

            [
                'id' => 19,
                'konstruksi_divisi_id' => 4,
                'sub_code_id' => null,
                'satuan_id' => 4,
                'nama' => 'Biaya Promosi',
                'jumlah' => 0.25,
                'harga' => 53762950000,
                'total_harga' => 134407375,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => true,
            ],
            [
                'id' => 20,
                'konstruksi_divisi_id' => 4,
                'sub_code_id' => null,
                'satuan_id' => 4,
                'nama' => 'Biaya Ops. Marketing',
                'jumlah' => 3.5,
                'harga' => 53762950000,
                'total_harga' => 0.5,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => true,
            ],

            [
                'id' => 21,
                'konstruksi_divisi_id' => 5,
                'sub_code_id' => null,
                'satuan_id' => 19,
                'nama' => 'Biaya Pra-Operasional',
                'jumlah' => 1,
                'harga' => 50000000,
                'total_harga' => 50000000,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],
            [
                'id' => 22,
                'konstruksi_divisi_id' => 5,
                'sub_code_id' => null,
                'satuan_id' => 4,
                'nama' => 'Biaya Operasional & Management',
                'jumlah' => 5,
                'harga' => 29104923099,
                'total_harga' => 29104923099,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => true,
            ],
            [
                'id' => 23,
                'konstruksi_divisi_id' => 5,
                'sub_code_id' => null,
                'satuan_id' => 4,
                'nama' => 'Biaya Lain - lain',
                'jumlah' => 0,
                'harga' => 0,
                'total_harga' => 0,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],

            [
                'id' => 24,
                'konstruksi_divisi_id' => 6,
                'sub_code_id' => null,
                'satuan_id' => 4,
                'nama' => 'Pajak - Pajak Perumahan',
                'jumlah' => 1,
                'harga' => 440000000,
                'total_harga' => 1344073750,
                'has_child' => false,
                'is_option' => false,
                'is_percentage' => false,
            ],
        ]);
    }
}
