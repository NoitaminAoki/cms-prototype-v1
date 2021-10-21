<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsKonstruksiSubDivisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_konstruksi_sub_divisis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('konstruksi_divisi_id')->nullable();
            $table->unsignedBigInteger('sub_code_id')->nullable();
            $table->unsignedBigInteger('satuan_id')->nullable();
            $table->string('nama');
            $table->float('jumlah')->nullable();
            $table->bigInteger('harga')->nullable();
            $table->bigInteger('total_harga')->nullable();
            $table->boolean('has_child')->default(false);
            $table->boolean('is_option')->default(false);
            $table->boolean('is_percentage')->default(false);
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
        Schema::dropIfExists('ms_konstruksi_sub_divisis');
    }
}
