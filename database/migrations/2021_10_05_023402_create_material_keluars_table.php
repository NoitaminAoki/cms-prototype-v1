<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialKeluarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_keluars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_detail_id')->nullable();
            $table->unsignedBigInteger('realisasi_dana_id')->nullable();
            $table->integer('jumlah');
            $table->timestamp('tanggal')->useCurrent();
            $table->string('photo_path');
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
        Schema::dropIfExists('material_keluars');
    }
}
