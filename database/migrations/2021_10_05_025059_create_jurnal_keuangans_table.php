<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalKeuangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_keuangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kwitansi_id')->nullable();
            $table->unsignedBigInteger('kas_besar_id')->nullable();
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
        Schema::dropIfExists('jurnal_keuangans');
    }
}
