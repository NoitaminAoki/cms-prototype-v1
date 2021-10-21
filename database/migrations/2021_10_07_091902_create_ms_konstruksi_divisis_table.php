<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsKonstruksiDivisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ms_konstruksi_divisis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->boolean('has_template_view')->default(false);
            $table->bigInteger('total_harga')->nullable();
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
        Schema::dropIfExists('ms_konstruksi_divisis');
    }
}
