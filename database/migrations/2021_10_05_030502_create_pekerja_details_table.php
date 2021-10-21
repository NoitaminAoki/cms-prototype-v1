<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePekerjaDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pekerja_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jabatan_pekerja_id')->nullable();
            $table->integer('volume');
            $table->unsignedBigInteger('satuan_id')->nullable();
            $table->integer('harga_satuan');
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
        Schema::dropIfExists('pekerja_details');
    }
}
