<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCartTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cart', function (Blueprint $table) {
			$table->integer('addon_id')->nullable()->after('deal_quantity');
			$table->integer('addon_quantity')->nullable()->after('addon_id');
			$table->integer('addon_type_id')->nullable()->after('addon_quantity');
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
