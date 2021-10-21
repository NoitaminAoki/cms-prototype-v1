<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJurnalHariansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jurnal_harians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paket_id')->nullable();
            $table->string('format_code', 25);
            $table->bigInteger('total_harga');
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
        Schema::dropIfExists('jurnal_harians');
    }
}
