<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealisasiDanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi_danas', function (Blueprint $table) {
            $table->id();
            $table->string('format_code', 25);
            $table->unsignedBigInteger('kwitansi_id')->nullable();
            $table->unsignedBigInteger('pengajuan_dana_id')->nullable();
            $table->unsignedBigInteger('divisi_id')->nullable();
            $table->string('asal');
            $table->string('keterangan')->nullable();
            $table->timestamp('tanggal')->useCurrent();
            $table->bigInteger('jumlah');
            $table->string('bukti_transfer_path')->nullable();
            $table->enum('status', ['process', 'complete']);
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
        Schema::dropIfExists('realisasi_danas');
    }
}
