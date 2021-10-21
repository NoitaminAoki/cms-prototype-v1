<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_details', function (Blueprint $table) {
            $table->id();
            $table->string('nama_material');
            $table->unsignedBigInteger('nested_sub_code_id');
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
        Schema::dropIfExists('material_details');
    }
}
