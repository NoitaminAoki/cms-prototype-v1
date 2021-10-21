<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialPengajuanDanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_pengajuan_danas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_dana_id')->nullable();
            $table->unsignedBigInteger('material_detail_id')->nullable();
            $table->integer('harga_satuan');
            $table->integer('total_harga');
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
        Schema::dropIfExists('material_pengajuan_danas');
    }
}
