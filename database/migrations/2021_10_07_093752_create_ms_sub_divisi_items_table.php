<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsSubDivisiItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_sub_divisi_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_divisi_id')->nullable();
            $table->unsignedBigInteger('satuan_id')->nullable();
            $table->string('nama');
            $table->integer('jumlah')->nullable();
            $table->bigInteger('harga')->nullable();
            $table->bigInteger('total_harga')->nullable();
            $table->boolean('is_calculated_price')->default(false);
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
        Schema::dropIfExists('ms_sub_divisi_items');
    }
}
