<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListMaterialSubItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_material_sub_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_item_id')->nullable();
            $table->unsignedBigInteger('sub_item_group_id')->nullable();
            $table->unsignedBigInteger('material_detail_id')->nullable();
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
        Schema::dropIfExists('list_material_sub_items');
    }
}
