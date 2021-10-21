<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('material_details')->insert([
            [
                'nama_material' => 'Semen PC ( 40 Kg./Zak )',
                'nested_sub_code_id' => 7,
                'volume' => 2680,
                'satuan_id' => 10,
                'harga_satuan' => 65000
            ],
            [
                'nama_material' => 'Batu Split / Koral',
                'nested_sub_code_id' => 9,
                'volume' => 87,
                'satuan_id' => 3,
                'harga_satuan' => 272838
            ],
            [
                'nama_material' => 'Batu Belah',
                'nested_sub_code_id' => 9,
                'volume' => 411,
                'satuan_id' => 3,
                'harga_satuan' => 219938
            ],
            [
                'nama_material' => 'Bata Merah',
                'nested_sub_code_id' => 8,
                'volume' => 13894,
                'satuan_id' => 6,
                'harga_satuan' => 700
            ],
            [
                'nama_material' => 'Bata Ringan (Hebel 7,5)',
                'nested_sub_code_id' => 8,
                'volume' => 288,
                'satuan_id' => 3,
                'harga_satuan' => 800000
            ],
            [
                'nama_material' => 'Batako',
                'nested_sub_code_id' => 20,
                'volume' => 17940,
                'satuan_id' => 3,
                'harga_satuan' => 260000
            ],
            [
                'nama_material' => 'Semen Mortar Perekat (LEMKRA)',
                'nested_sub_code_id' => 7,
                'volume' => 32,
                'satuan_id' => 11,
                'harga_satuan' => 44000
            ],
            [
                'nama_material' => 'Pasir',
                'nested_sub_code_id' => 11,
                'volume' => 237,
                'satuan_id' => 3,
                'harga_satuan' => 270000
            ],
            [
                'nama_material' => 'Besi Ø 12',
                'nested_sub_code_id' => 10,
                'volume' => 2,
                'satuan_id' => 12,
                'harga_satuan' => 76000
            ],
            [
                'nama_material' => 'Besi Ø 10',
                'nested_sub_code_id' => 10,
                'volume' => 502,
                'satuan_id' => 12,
                'harga_satuan' => 58000
            ],
            [
                'nama_material' => 'Besi Ø 8',
                'nested_sub_code_id' => 10,
                'volume' => 752,
                'satuan_id' => 12,
                'harga_satuan' => 47000
            ],
            [
                'nama_material' => 'Besi Ø 6',
                'nested_sub_code_id' => 10,
                'volume' => 867,
                'satuan_id' => 12,
                'harga_satuan' => 40000
            ],
            [
                'nama_material' => 'Kawat ( Bendrat )',
                'nested_sub_code_id' => 10,
                'volume' => 135,
                'satuan_id' => 5,
                'harga_satuan' => 20000
            ],
            [
                'nama_material' => 'Papan Cor ( 2 x 20 )',
                'nested_sub_code_id' => 21,
                'volume' => 93,
                'satuan_id' => 13,
                'harga_satuan' => 20000
            ],
            [
                'nama_material' => 'Papan Cor ( 2 x 15 )',
                'nested_sub_code_id' => 21,
                'volume' => 23,
                'satuan_id' => 13,
                'harga_satuan' => 14000
            ],
            [
                'nama_material' => 'Kasau ( 4 X 6 )',
                'nested_sub_code_id' => 21,
                'volume' => 49,
                'satuan_id' => 12,
                'harga_satuan' => 19000
            ],
            [
                'nama_material' => 'Triplek 9 mm',
                'nested_sub_code_id' => 21,
                'volume' => 12,
                'satuan_id' => 4,
                'harga_satuan' => 121000
            ],
            [
                'nama_material' => 'Paku 2" s/d 5"',
                'nested_sub_code_id' => 21,
                'volume' => 64,
                'satuan_id' => 5,
                'harga_satuan' => 16600
            ],
            [
                'nama_material' => 'Tanah Urug',
                'nested_sub_code_id' => 6,
                'volume' => 11,
                'satuan_id' => 3,
                'harga_satuan' => 183000
            ],
            [
                'nama_material' => 'Pasir Urug',
                'nested_sub_code_id' => 6,
                'volume' => 28,
                'satuan_id' => 3,
                'harga_satuan' => 183000
            ],

            [
                'nama_material' => 'Genteng Beton',
                'nested_sub_code_id' => 16,
                'volume' => 1254,
                'satuan_id' => 6,
                'harga_satuan' => 5100
            ],
            [
                'nama_material' => 'Nok ( Bumbungan )',
                'nested_sub_code_id' => 21,
                'volume' => 300,
                'satuan_id' => 6,
                'harga_satuan' => 25000
            ],
            [
                'nama_material' => 'Lisplang',
                'nested_sub_code_id' => 21,
                'volume' => 41,
                'satuan_id' => 1,
                'harga_satuan' => 27000
            ],
            [
                'nama_material' => 'Galvalume ( Main Truss C-75-75 )',
                'nested_sub_code_id' => 21,
                'volume' => 59,
                'satuan_id' => 1,
                'harga_satuan' => 80000
            ],
            [
                'nama_material' => 'Galvalume ( Roof Bottom / Reng R 33-0.45 )',
                'nested_sub_code_id' => 21,
                'volume' => 108,
                'satuan_id' => 1,
                'harga_satuan' => 22000
            ],
            [
                'nama_material' => 'Hollow 2 x 4',
                'nested_sub_code_id' => 21,
                'volume' => 92,
                'satuan_id' => 12,
                'harga_satuan' => 28000
            ],
            [
                'nama_material' => 'Gypsumbord ( 122 Cm x 144 Cm )',
                'nested_sub_code_id' => 21,
                'volume' => 47,
                'satuan_id' => 14,
                'harga_satuan' => 65000
            ],
            [
                'nama_material' => 'List Plafon Gypsum ( P = 195 Cm )',
                'nested_sub_code_id' => 21,
                'volume' => 65,
                'satuan_id' => 12,
                'harga_satuan' => 7000
            ],
            [
                'nama_material' => 'Compoun',
                'nested_sub_code_id' => 21,
                'volume' => 18,
                'satuan_id' => 5,
                'harga_satuan' => 4500
            ],
            [
                'nama_material' => 'Self Drilling Screw Dia-6 x 20 mm',
                'nested_sub_code_id' => 21,
                'volume' => 3545,
                'satuan_id' => 6,
                'harga_satuan' => 275
            ],
            [
                'nama_material' => 'Self Drilling Screw Dia-4 x 16 mm',
                'nested_sub_code_id' => 21,
                'volume' => 4126,
                'satuan_id' => 6,
                'harga_satuan' => 225
            ],
            [
                'nama_material' => 'Paku Baja Besar',
                'nested_sub_code_id' => 21,
                'volume' => 6,
                'satuan_id' => 15,
                'harga_satuan' => 16000
            ],
            [
                'nama_material' => 'Paku Baja Kecil',
                'nested_sub_code_id' => 21,
                'volume' => 3,
                'satuan_id' => 15,
                'harga_satuan' => 8000
            ],
            [
                'nama_material' => 'Kusen Pintu dan Jend. Alumunium',
                'nested_sub_code_id' => 12,
                'volume' => 24,
                'satuan_id' => 1,
                'harga_satuan' => 118000
            ],

            [
                'nama_material' => 'Daun Pintu Panil Kayu kelas II',
                'nested_sub_code_id' => 12,
                'volume' => 6,
                'satuan_id' => 2,
                'harga_satuan' => 277778
            ],
            [
                'nama_material' => 'Rangka Daun Jend. Kaca Kayu kl. II ( 2 Unit )',
                'nested_sub_code_id' => 12,
                'volume' => 2,
                'satuan_id' => 2,
                'harga_satuan' => 277778
            ],
            [
                'nama_material' => 'Kaca Pintu dan Jendela Tb : 5 mm',
                'nested_sub_code_id' => 12,
                'volume' => 1,
                'satuan_id' => 2,
                'harga_satuan' => 97500
            ],
            [
                'nama_material' => 'Kusen Pintu dan Jend. Kayu kelas II',
                'nested_sub_code_id' => 12,
                'volume' => 9,
                'satuan_id' => 1,
                'harga_satuan' => 118000
            ],
            [
                'nama_material' => 'Daun Pintu Penutup Kayu Lapis',
                'nested_sub_code_id' => 12,
                'volume' => 2,
                'satuan_id' => 2,
                'harga_satuan' => 277778
            ],
            [
                'nama_material' => 'Rangka Daun Jend. Kaca Kayu kl. II',
                'nested_sub_code_id' => 12,
                'volume' => 1,
                'satuan_id' => 2,
                'harga_satuan' => 104000
            ],
            [
                'nama_material' => 'Kaca Pintu dan Jendela Tb : 5 mm',
                'nested_sub_code_id' => 12,
                'volume' => 1,
                'satuan_id' => 2,
                'harga_satuan' => 97500
            ],
            [
                'nama_material' => 'Kusen Pintu Kayu kelas II ( 2 Unit )',
                'nested_sub_code_id' => 12,
                'volume' => 11,
                'satuan_id' => 1,
                'harga_satuan' => 118000
            ],
            [
                'nama_material' => 'Daun Pintu Penutup Kayu Lapis ( 2 Unit )',
                'nested_sub_code_id' => 12,
                'volume' => 4,
                'satuan_id' => 2,
                'harga_satuan' => 226885
            ],
            [
                'nama_material' => 'Pintu PVC Lengkap + Kunci',
                'nested_sub_code_id' => 12,
                'volume' => 1,
                'satuan_id' => 8,
                'harga_satuan' => 210000
            ],
            [
                'nama_material' => 'Kusen Jendela Kayu kelas II ( 2 Lubang Jendela )',
                'nested_sub_code_id' => 12,
                'volume' => 6,
                'satuan_id' => 1,
                'harga_satuan' => 118000
            ],
            [
                'nama_material' => 'Rangka Daun Jend. Kaca Kayu kl. II ( 2 Unit Jendela )',
                'nested_sub_code_id' => 12,
                'volume' => 2,
                'satuan_id' => 2,
                'harga_satuan' => 104000
            ],
            [
                'nama_material' => 'Kaca Polos tb 5 mm',
                'nested_sub_code_id' => 12,
                'volume' => 1,
                'satuan_id' => 2,
                'harga_satuan' => 95000
            ],
            [
                'nama_material' => 'Kusen Jendela Kayu kelas II',
                'nested_sub_code_id' => 12,
                'volume' => 5,
                'satuan_id' => 1,
                'harga_satuan' => 118000
            ],
            [
                'nama_material' => 'Rangka Daun Jend. Kaca Kayu kl. II',
                'nested_sub_code_id' => 12,
                'volume' => 1,
                'satuan_id' => 2,
                'harga_satuan' => 104000
            ],
            [
                'nama_material' => 'Kaca Polos tb 5 mm',
                'nested_sub_code_id' => 12,
                'volume' => 1,
                'satuan_id' => 2,
                'harga_satuan' => 95000
            ],
            [
                'nama_material' => 'Kusen Jendela Kayu kelas II',
                'nested_sub_code_id' => 12,
                'volume' => 5,
                'satuan_id' => 1,
                'harga_satuan' => 118000
            ],
            [
                'nama_material' => 'Kaca Polos tb 5 mm',
                'nested_sub_code_id' => 12,
                'volume' => 1,
                'satuan_id' => 2,
                'harga_satuan' => 95000
            ],
            [
                'nama_material' => 'Roster Beton 25 x 20 x 12',
                'nested_sub_code_id' => 12,
                'volume' => 49,
                'satuan_id' => 1,
                'harga_satuan' => 8000
            ],
            [
                'nama_material' => 'Engsel Pintu',
                'nested_sub_code_id' => 12,
                'volume' => 36,
                'satuan_id' => 7,
                'harga_satuan' => 36225
            ],
            [
                'nama_material' => 'Handle Pintu Utama',
                'nested_sub_code_id' => 12,
                'volume' => 3,
                'satuan_id' => 8,
                'harga_satuan' => 47250
            ],
            [
                'nama_material' => 'Kunci untuk Pintu Utama',
                'nested_sub_code_id' => 12,
                'volume' => 3,
                'satuan_id' => 7,
                'harga_satuan' => 38000
            ],
            [
                'nama_material' => 'Handle + Kunci untuk pintu (Gabung)',
                'nested_sub_code_id' => 12,
                'volume' => 9,
                'satuan_id' => 8,
                'harga_satuan' => 49999
            ],
            [
                'nama_material' => 'Engsel Jendela',
                'nested_sub_code_id' => 12,
                'volume' => 36,
                'satuan_id' => 7,
                'harga_satuan' => 30000
            ],
            [
                'nama_material' => 'Grendel Jendela',
                'nested_sub_code_id' => 12,
                'volume' => 18,
                'satuan_id' => 7,
                'harga_satuan' => 21000
            ],
            [
                'nama_material' => 'Hak Sikutan Jendela',
                'nested_sub_code_id' => 12,
                'volume' => 18,
                'satuan_id' => 7,
                'harga_satuan' => 8500
            ],

            [
                'nama_material' => 'Keramik Lantai Rumah - 40 x 40 cm',
                'nested_sub_code_id' => 15,
                'volume' => 108,
                'satuan_id' => 2,
                'harga_satuan' => 50000
            ],
            [
                'nama_material' => 'Keramik Lantai Teras - 30 x 30 cm',
                'nested_sub_code_id' => 15,
                'volume' => 16,
                'satuan_id' => 2,
                'harga_satuan' => 45000
            ],
            [
                'nama_material' => 'Keramik Lantai KM/WC Dan Dapur - 20 x 20 cm',
                'nested_sub_code_id' => 15,
                'volume' => 12,
                'satuan_id' => 2,
                'harga_satuan' => 45000
            ],
            [
                'nama_material' => 'Keramik Dinding KM/WC - 20 x 25 cm',
                'nested_sub_code_id' => 15,
                'volume' => 27,
                'satuan_id' => 2,
                'harga_satuan' => 45000
            ],
            [
                'nama_material' => 'Semen Warna',
                'nested_sub_code_id' => 15,
                'volume' => 11,
                'satuan_id' => 5,
                'harga_satuan' => 14847
            ],

            [
                'nama_material' => 'Fitting Lampu Lengkap',
                'nested_sub_code_id' => 13,
                'volume' => 23,
                'satuan_id' => 6,
                'harga_satuan' => 8000
            ],
            [
                'nama_material' => 'Bolham Lampu',
                'nested_sub_code_id' => 13,
                'volume' => 23,
                'satuan_id' => 6,
                'harga_satuan' => 9000
            ],
            [
                'nama_material' => 'Saklar Single',
                'nested_sub_code_id' => 13,
                'volume' => 10,
                'satuan_id' =>6,
                'harga_satuan' => 24500
            ],
            [
                'nama_material' => 'Saklar Double',
                'nested_sub_code_id' => 13,
                'volume' => 5,
                'satuan_id' => 6,
                'harga_satuan' => 24500
            ],
            [
                'nama_material' => 'Stop Kontak',
                'nested_sub_code_id' => 13,
                'volume' => 16,
                'satuan_id' => 6,
                'harga_satuan' => 23000
            ],
            [
                'nama_material' => 'MCB 6 Ampere',
                'nested_sub_code_id' => 13,
                'volume' => 3,
                'satuan_id' => 6,
                'harga_satuan' => 58000
            ],
            [
                'nama_material' => 'Box Panel',
                'nested_sub_code_id' => 13,
                'volume' => 3,
                'satuan_id' => 6,
                'harga_satuan' => 12000
            ],
            [
                'nama_material' => 'Kabel NYA 4 mm',
                'nested_sub_code_id' => 13,
                'volume' => 393,
                'satuan_id' => 1,
                'harga_satuan' => 4640
            ],
            [
                'nama_material' => 'Pipa PVC - 5/8 D',
                'nested_sub_code_id' => 13,
                'volume' => 49,
                'satuan_id' => 12,
                'harga_satuan' => 6000
            ],
            [
                'nama_material' => 'Inbow Doos',
                'nested_sub_code_id' => 13,
                'volume' => 38,
                'satuan_id' => 6,
                'harga_satuan' => 1300
            ],
            [
                'nama_material' => 'Lbow - 5/8 D',
                'nested_sub_code_id' => 13,
                'volume' => 120,
                'satuan_id' => 6,
                'harga_satuan' => 750
            ],
            [
                'nama_material' => 'Isolator',
                'nested_sub_code_id' => 13,
                'volume' => 17,
                'satuan_id' => 6,
                'harga_satuan' => 8000
            ],

            [
                'nama_material' => 'Plamir Tembok',
                'nested_sub_code_id' => 14,
                'volume' => 24,
                'satuan_id' => 5,
                'harga_satuan' => 23000
            ],
            [
                'nama_material' => 'Cat Dasar Tembok',
                'nested_sub_code_id' => 14,
                'volume' => 24,
                'satuan_id' => 5,
                'harga_satuan' => 34000
            ],
            [
                'nama_material' => 'Cat Tembok Interior',
                'nested_sub_code_id' => 14,
                'volume' => 114,
                'satuan_id' => 5,
                'harga_satuan' => 50000
            ],
            [
                'nama_material' => 'Cat Tembok Ekterior',
                'nested_sub_code_id' => 14,
                'volume' => 82,
                'satuan_id' => 5,
                'harga_satuan' => 80000
            ],
            [
                'nama_material' => 'Cat Dasar Kayu/Besi',
                'nested_sub_code_id' => 14,
                'volume' => 24,
                'satuan_id' => 5,
                'harga_satuan' => 72500
            ],
            [
                'nama_material' => 'Cat Kayu/Besi',
                'nested_sub_code_id' => 14,
                'volume' => 22,
                'satuan_id' => 5,
                'harga_satuan' => 67500
            ],
            [
                'nama_material' => 'Cat Meni Kayu',
                'nested_sub_code_id' => 14,
                'volume' => 17,
                'satuan_id' => 5,
                'harga_satuan' => 33000
            ],
            [
                'nama_material' => 'Plamir/Dempul Kayu',
                'nested_sub_code_id' => 14,
                'volume' => 12,
                'satuan_id' => 5,
                'harga_satuan' => 34000
            ],
            [
                'nama_material' => 'Tiner A',
                'nested_sub_code_id' => 14,
                'volume' => 12,
                'satuan_id' => 16,
                'harga_satuan' => 21000
            ],
            [
                'nama_material' => 'Plamir Tembok',
                'nested_sub_code_id' => 14,
                'volume' => 24,
                'satuan_id' => 5,
                'harga_satuan' => 21000
            ],
            [
                'nama_material' => 'Roll Cat',
                'nested_sub_code_id' => 14,
                'volume' => 11,
                'satuan_id' => 6,
                'harga_satuan' => 27000
            ],
            [
                'nama_material' => 'Kuas',
                'nested_sub_code_id' => 14,
                'volume' => 6,
                'satuan_id' => 6,
                'harga_satuan' => 13000
            ],
            [
                'nama_material' => 'Kertas Gosok ( 50% Halus , 50% Kasar )',
                'nested_sub_code_id' => 14,
                'volume' => 165,
                'satuan_id' => 13,
                'harga_satuan' => 5500
            ],

            [
                'nama_material' => 'Closed Duduk',
                'nested_sub_code_id' => 18,
                'volume' => 3,
                'satuan_id' => 8,
                'harga_satuan' => 1050000
            ],
            [
                'nama_material' => 'Double Kran + Shower ( Komplit )',
                'nested_sub_code_id' => 18,
                'volume' => 3,
                'satuan_id' => 8,
                'harga_satuan' => 121000
            ],
            [
                'nama_material' => 'Floor Drain',
                'nested_sub_code_id' => 18,
                'volume' => 3,
                'satuan_id' => 6,
                'harga_satuan' => 15000
            ],
            [
                'nama_material' => 'Kitchen Zink',
                'nested_sub_code_id' => 18,
                'volume' => 3,
                'satuan_id' => 6,
                'harga_satuan' => 230000
            ],
            [
                'nama_material' => 'Kran 3/4"',
                'nested_sub_code_id' => 18,
                'volume' => 6,
                'satuan_id' => 6,
                'harga_satuan' => 9000
            ],
            [
                'nama_material' => 'Kran Cuci Piring 3/4"',
                'nested_sub_code_id' => 18,
                'volume' => 3,
                'satuan_id' => 6,
                'harga_satuan' => 24000
            ],
            [
                'nama_material' => 'Pipa PVC 3/4" AW',
                'nested_sub_code_id' => 18,
                'volume' => 12,
                'satuan_id' => 12,
                'harga_satuan' => 30500
            ],
            [
                'nama_material' => 'Pipa PVC  2" AW',
                'nested_sub_code_id' => 18,
                'volume' => 3,
                'satuan_id' => 12,
                'harga_satuan' => 89500
            ],
            [
                'nama_material' => 'Pipa PVC  3" AW',
                'nested_sub_code_id' => 18,
                'volume' => 6,
                'satuan_id' => 12,
                'harga_satuan' => 172000
            ],
            [
                'nama_material' => 'Pipa PVC  4" AW',
                'nested_sub_code_id' => 18,
                'volume' => 9,
                'satuan_id' => 12,
                'harga_satuan' => 250000
            ],
            [
                'nama_material' => 'Knee PVC 3/4" AW',
                'nested_sub_code_id' => 18,
                'volume' => 21,
                'satuan_id' => 6,
                'harga_satuan' => 4000
            ],
            [
                'nama_material' => 'Knee PVC  2" AW',
                'nested_sub_code_id' => 18,
                'volume' => 7,
                'satuan_id' => 6,
                'harga_satuan' => 14000
            ],
            [
                'nama_material' => 'Knee PVC  3" AW',
                'nested_sub_code_id' => 18,
                'volume' => 9,
                'satuan_id' => 6,
                'harga_satuan' => 12000
            ],
            [
                'nama_material' => 'Knee PVC  4" AW',
                'nested_sub_code_id' => 18,
                'volume' => 6,
                'satuan_id' => 6,
                'harga_satuan' => 14000
            ],
            [
                'nama_material' => 'Tee PVC 3/4" AW',
                'nested_sub_code_id' => 18,
                'volume' => 12,
                'satuan_id' => 6,
                'harga_satuan' => 2500
            ],
            [
                'nama_material' => 'Sock Drat Dalam PVC 3/4 AW',
                'nested_sub_code_id' => 18,
                'volume' => 9,
                'satuan_id' => 6,
                'harga_satuan' => 3000
            ],
            [
                'nama_material' => 'Lem PVC Isarplas Kaleng 400 g',
                'nested_sub_code_id' => 18,
                'volume' => 3,
                'satuan_id' => 17,
                'harga_satuan' => 40000
            ],
            [
                'nama_material' => 'Alat Kerja ( Gergaji Besi )',
                'nested_sub_code_id' => 18,
                'volume' => 12,
                'satuan_id' => 6,
                'harga_satuan' => 4500
            ],
            [
                'nama_material' => 'Isolotif',
                'nested_sub_code_id' => 18,
                'volume' => 3,
                'satuan_id' => 6,
                'harga_satuan' => 2000
            ],

            [
                'nama_material' => 'Pemasangan Galvalum ( Sewa Bor dan Listrik )',
                'nested_sub_code_id' => 22,
                'volume' => 378,
                'satuan_id' => 4,
                'harga_satuan' => 1500
            ],
            [
                'nama_material' => 'Pengecatan Kusen Pintu ( Sewa Alat Semprot dan Kompresor )',
                'nested_sub_code_id' => 22,
                'volume' => 108,
                'satuan_id' => 2,
                'harga_satuan' => 5000
            ],
            [
                'nama_material' => 'Alat pembersihan Lapangan',
                'nested_sub_code_id' => 22,
                'volume' => 3,
                'satuan_id' => 4,
                'harga_satuan' => 60000
            ],
        ]);
    }
}
