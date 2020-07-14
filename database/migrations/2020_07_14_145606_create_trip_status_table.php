<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_status', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        DB::table('trip_status')->insert([
            [
                'name' => 'TR',
                'description' => 'Trip Request',
            ],
        ]);

        DB::table('trip_status')->insert([
            [
                'name' => 'TRA',
                'description' => 'Trip Request Accept',
            ],
        ]);

        DB::table('trip_status')->insert([
            [
                'name' => 'TRDA',
                'description' => 'Trip Request Driver Arrived',
            ],
        ]);

        DB::table('trip_status')->insert([
            [
                'name' => 'TS',
                'description' => 'Trip Started',
            ],
        ]);

        DB::table('trip_status')->insert([
            [
                'name' => 'TC',
                'description' => 'Trip Complete',
            ],
        ]);
        DB::table('trip_status')->insert([
            [
                'name' => 'TPDD',
                'description' => 'Trip Payment Done', // Cash Collected
            ],
        ]);

        DB::table('trip_status')->insert([
            [
                'name' => 'TCRD',
                'description' => 'Trip Complete Rating Done',
            ],
        ]);

        DB::table('trip_status')->insert([
            [
                'name' => 'TRRD',
                'description' => 'Trip Request Rejected Driver',
            ],
        ]);

        DB::table('trip_status')->insert([
            [
                'name' => 'TRA',
                'description' => 'Trip Request Rejected By Driver After Accept',
            ],
        ]);

        DB::table('trip_status')->insert([
            [
                'name' => 'TRRU',
                'description' => 'Trip Request Rejected By User',
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trip_status');
    }
}
