<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahapPengerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahap_pengerjaans', function (Blueprint $table) {
            $table->id();
            $table->string('code', 25);
            $table->unsignedBigInteger('kontraktor_id')->nullable();
            $table->unsignedBigInteger('divisi_id')->nullable();
            $table->unsignedBigInteger('paket_id')->nullable();
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
        Schema::dropIfExists('tahap_pengerjaans');
    }
}
