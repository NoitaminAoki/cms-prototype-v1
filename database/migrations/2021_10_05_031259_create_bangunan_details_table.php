<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBangunanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangunan_details', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bangunan');
            $table->unsignedBigInteger('type_bangunan_id')->nullable();
            $table->integer('jumlah_unit');
            $table->float('luas', 8, 2);
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
        Schema::dropIfExists('bangunan_details');
    }
}
