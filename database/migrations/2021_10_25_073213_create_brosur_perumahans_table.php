<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrosurPerumahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brosur_perumahans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->uuid('origin_uuid')->nullable();
            $table->string('full_path');
            $table->string('origin_sector_id', 15)->nullable();
            $table->string('sector_id', 15);
            $table->string('pdf_real_name');
            $table->string('pdf_name');
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
        Schema::dropIfExists('brosur_perumahans');
    }
}
