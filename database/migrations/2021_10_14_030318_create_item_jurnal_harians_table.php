<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemJurnalHariansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_jurnal_harians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_id')->nullable();
            $table->string('nama');
            $table->integer('jumlah');
            $table->integer('harga_satuan');
            $table->integer('total_harga');
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
        Schema::dropIfExists('item_jurnal_harians');
    }
}
