<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CerateDealVariation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deal_variations', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('menu_item_id')->nullable();
            $table->string('items')->nullable();
            $table->string('drinks')->nullable();
            $table->string('sides')->nullable();
            $table->string('extras')->nullable();
            $table->string('addons')->nullable();
			
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
        Schema::dropIfExists('deal_variations');
    }
}
