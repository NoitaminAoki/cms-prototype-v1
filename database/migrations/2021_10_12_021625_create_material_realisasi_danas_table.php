<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialRealisasiDanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_realisasi_danas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('realisasi_dana_id')->nullable();
            $table->unsignedBigInteger('material_pengajuan_dana_id')->nullable();
            $table->unsignedBigInteger('material_detail_id')->nullable();
            $table->integer('jumlah');
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
        Schema::dropIfExists('material_realisasi_danas');
    }
}
