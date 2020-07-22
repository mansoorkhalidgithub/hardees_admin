<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('addon_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
        });
		
        Schema::create('addons', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('addon_category_id')->nullable();
            $table->string('name')->nullable();
			$table->string('image')->nullable();
			
			$table->foreign('addon_category_id')->references('id')->on('addon_categories')->onDelete('cascade');
        });
		
		Schema::create('addon_types', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('addon_id')->nullable();
            $table->string('size')->nullable();
			$table->double('price', 8, 2)->nullable();
			
			$table->foreign('addon_id')->references('id')->on('addons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addons');
    }
}
