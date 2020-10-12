<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateItemVariation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_variations', function (Blueprint $table) {
           // $table->string('deal_drinks')->nullable();
            $table->string('drink_options')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_variations', function (Blueprint $table) {
            $table->string('deal_drinks')->nullable();
        });
    }
}
