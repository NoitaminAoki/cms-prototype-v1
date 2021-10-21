<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemJurnalHarianMasuksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_jurnal_harian_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('sumber');
            $table->integer('jumlah');
            $table->timestamp('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_jurnal_harian_masuks');
    }
}
