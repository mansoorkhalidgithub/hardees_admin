<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateAddon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('addons', function (Blueprint $table) {
			
			$table->unsignedBigInteger('menu_item_id')->nullable();
			
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
