<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBucket extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bucket', function (Blueprint $table) {
            $table->renameColumn('deal_quantity', 'deal_drinks');
        });

        Schema::table('order_variations', function (Blueprint $table) {
            $table->renameColumn('deal_quantity', 'deal_drinks');
        });

        // Schema::table('bucket', function (Blueprint $table) {
        //     $table->renameColumn('deal_quantity', 'deal_drinks');
        // });
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
