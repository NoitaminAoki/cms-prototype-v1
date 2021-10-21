<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasBesarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas_besars', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi_bank')->nullable();
            $table->enum('tipe_transaksi', ['debit', 'kredit']);
            $table->string('sumber');
            $table->bigInteger('jumlah');
            $table->timestamp('tanggal')->useCurrent();
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
        Schema::dropIfExists('kas_besars');
    }
}
