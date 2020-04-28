<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Menu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_category_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('name')->unique();
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->unsignedInteger('quantity')->nullable();
            $table->double('price', 8, 2)->nullable();
            $table->double('discount', 8, 2)->nullable();
            $table->string('image')->nullable();
            $table->text('ingredients')->nullable();
            $table->timestamps();

            $table->foreign('menu_category_id')->references('id')->on('menu_categories')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('auth')->onDelete('cascade');
        });
		
		Schema::create('deals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });

        Schema::create('deal_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('deal_id')->nullable();
            $table->unsignedBigInteger('menu_item_id')->nullable();

            $table->foreign('deal_id')->references('id')->on('deals')->onDelete('cascade');
            $table->foreign('menu_item_id')->references('id')->on('menu_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
