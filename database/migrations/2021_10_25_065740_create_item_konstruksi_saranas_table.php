<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemKonstruksiSaranasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_konstruksi_saranas', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('full_path');
            $table->unsignedBigInteger('konstruksi_sarana_id')->nullable();
            $table->string('sector_id', 15);
            $table->string('image_real_name');
            $table->string('image_name');
            $table->string('base_path');
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
        Schema::dropIfExists('item_konstruksi_saranas');
    }
}
