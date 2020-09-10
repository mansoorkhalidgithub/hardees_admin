<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRiderStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rider_id');
            $table->string('online_status')->nullable();
            $table->string('trip_status')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->timestamps();

            $table->foreign('rider_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rider_status');
    }
}
