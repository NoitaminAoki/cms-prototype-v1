<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubItemPengerjaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_item_pengerjaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('nama');
            $table->boolean('has_group')->default(false);
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
        Schema::dropIfExists('sub_item_pengerjaans');
    }
}
