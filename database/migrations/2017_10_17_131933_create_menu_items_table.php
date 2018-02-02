<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('menu_id');
            $table->unsignedInteger('user_id');
            $table->string('menu_item_category')->nullable();
            $table->binary('menu_item_image')->nullable();
            $table->string('menu_item_title')->nullable();
            $table->text('menu_item_description')->nullable();
            $table->string('menu_item_price')->nullable();
            $table->string('menu_item_price_details')->nullable();
            $table->text('nutritional_info')->nullable();
            $table->text('allergen_info')->nullable();
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
        Schema::dropIfExists('menu_items');
    }
}
