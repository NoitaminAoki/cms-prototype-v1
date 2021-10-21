<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahap_pengerjaan_id')->nullable();
            $table->unsignedBigInteger('item_detail_id')->nullable();
            $table->unsignedBigInteger('cuaca_id')->nullable();
            $table->timestamp('tanggal')->useCurrent();
            $table->text('catatan');
            $table->string('photo_path');
            $table->string('pelaksana');
            $table->string('pengawas');
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
        Schema::dropIfExists('laporans');
    }
}
