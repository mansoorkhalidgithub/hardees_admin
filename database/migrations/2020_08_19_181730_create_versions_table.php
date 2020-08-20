<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('android');
            $table->string('ios');
            $table->string('type');
        });

        DB::table('versions')->insert([
            [
                'android' => '1.0.3',
                'ios' => '1.0.3',
                'type' => 'rider',
            ],
        ]);
        DB::table('versions')->insert([
            [
                'android' => '1.0.3',
                'ios' => '1.0.3',
                'type' => 'restaurant',
            ],
        ]);
        DB::table('versions')->insert([
            [
                'android' => '1.0.3',
                'ios' => '1.0.3',
                'type' => 'user',
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
        Schema::dropIfExists('versions');
    }
}
