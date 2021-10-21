<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DivisiSeeder::class,
            MsCodeSeeder::class,
            MsSubCodeSeeder::class,
            MsNestedSubCodeSeeder::class,
            MsSatuanSeeder::class,
            MaterialDetailSeeder::class,
            SubItemSeeder::class,
            SubItemPengerjaanSeeder::class,
            SubItemGroupSeeder::class,
            ListMaterialSubItemSeeder::class,
            MsKontruksiDivisiSeeder::class,
            MsKontruksiSubDivisiSeeder::class,
            MsSubDivisiItemSeeder::class,
            MsCodePaketSeeder::class,
            RoleAndPermissionSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
