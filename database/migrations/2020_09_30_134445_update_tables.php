<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('menu_items', function (Blueprint $table) {
            
			// $table->integer('quantity')->nullable();
		// });	
		
		Schema::table('drinks', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurant_id')->nullable();
			$table->integer('quantity')->nullable();
            $table->tinyInteger('active');
	
			$table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
		
		Schema::table('sides', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurant_id')->nullable();
			$table->integer('quantity')->nullable();
            $table->tinyInteger('active');
	
			$table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
		
		Schema::table('extra_patties', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurant_id')->nullable();
			$table->integer('quantity')->nullable();
            $table->tinyInteger('active');
	
			$table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
		
		Schema::table('addons', function (Blueprint $table) {
            $table->unsignedBigInteger('restaurant_id')->nullable();
			$table->integer('quantity')->nullable();
            $table->tinyInteger('active');
	
			$table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('menu_items', function (Blueprint $table) {
            
        // });
    }
}
