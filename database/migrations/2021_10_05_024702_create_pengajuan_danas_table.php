<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanDanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_danas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('divisi_id')->nullable();
            $table->unsignedBigInteger('paket_id')->nullable();
            $table->unsignedBigInteger('sub_divisi_item_id')->nullable();
            $table->timestamp('tanggal')->useCurrent();
            $table->string('keterangan')->nullable();
            $table->string('pembuat_pengajuan');
            $table->bigInteger('total_harga_material')->default(0);
            $table->enum('status_pengajuan', ['pending', 'process', 'complete']);
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
        Schema::dropIfExists('pengajuan_danas');
    }
}
