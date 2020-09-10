<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuVariations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('variations', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name');
        });
		
		DB::table('variations')->insert(['name' => 'Ala Carte']);
		DB::table('variations')->insert(['name' => 'With Drink']);
		DB::table('variations')->insert(['name' => 'Regular Combo']);
		DB::table('variations')->insert(['name' => 'Medium Combo']);
		DB::table('variations')->insert(['name' => 'Large Combo']);
		
		Schema::create('drinks', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name');
			$table->integer('default')->nullable();
			$table->double('price', 8, 2)->nullable();
        });
		
		DB::table('drinks')->insert(['name' => 'Coke', 'price' => 50, 'default' => 1]);
		DB::table('drinks')->insert(['name' => 'Sprite', 'price' => 50, 'default' => 1]);
		DB::table('drinks')->insert(['name' => 'Fanta', 'price' => 50, 'default' => 1]);
		DB::table('drinks')->insert(['name' => 'Strawberry Shake', 'price' => 270]);
		DB::table('drinks')->insert(['name' => 'Chocolate Shake', 'price' => 270]);
		DB::table('drinks')->insert(['name' => 'Vanilla Shake', 'price' => 270]);
		DB::table('drinks')->insert(['name' => 'Coffee Shake', 'price' => 270]);
		
		Schema::create('sides', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name');
			$table->double('price', 8, 2)->nullable();
			$table->integer('default')->nullable();
		});
		
		DB::table('sides')->insert(['name' => 'Natural Cut Fries', 'price' => 50, 'default' => 1]);
		DB::table('sides')->insert(['name' => 'Onion Rings', 'price' => 80]);
		DB::table('sides')->insert(['name' => 'Curly Fries', 'price' => 80]);
		
		Schema::create('extra_patties', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name');
			$table->double('price', 8, 2)->nullable();
		});
		
		DB::table('extra_patties')->insert(['name' => 'Large Meat', 'price' => 270]);
		DB::table('extra_patties')->insert(['name' => 'Angus Patty', 'price' => 370]);

		Schema::create('item_variations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('menu_item_id')->nullable();
            $table->unsignedBigInteger('variation_id')->nullable();
			$table->double('price', 8, 2)->nullable();
			$table->integer('is_drink')->nullable();
			$table->integer('is_side')->nullable();
			$table->integer('is_extra')->nullable();
			
			$table->foreign('menu_item_id')->references('id')->on('menu_items')->onDelete('cascade');
			$table->foreign('variation_id')->references('id')->on('variations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('extras');
        Schema::dropIfExists('sides');
        Schema::dropIfExists('drinks');
        Schema::dropIfExists('variations');
    }
}
