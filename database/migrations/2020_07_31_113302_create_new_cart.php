<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bucket', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('user_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('variation_id')->nullable();
            $table->integer('drink_id')->nullable();
			$table->integer('side_id')->nullable();
			$table->integer('extra_id')->nullable();
			$table->integer('quantity')->nullable();
			$table->string('addons')->nullable();
			$table->integer('deal_id')->nullable();
            $table->integer('deal_quantity')->nullable();
			$table->integer('status')->default(1);
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
        Schema::dropIfExists('new_cart');
    }
}
