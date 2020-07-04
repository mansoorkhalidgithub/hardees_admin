<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('username');
            $table->tinyInteger('type');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('phone_number')->nullable();
            $table->string('profile_picture')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('auth')->insert([
            [
                'first_name' => 'Muhammad',
                'last_name' => 'Qadeer',
                'username' => 'admin',
                'type' => '1',
                'email' => 'admin@hardees.com',
                'password' => '$2y$10$68N8GubryLRmUzyvecqpWuAbix3gURUBs.OJdjF5laaFA2.2OiF96',
                'phone_number' => '03336268994',
                'profile_picture' => '',
                'country_id' => 166,
                'state_id' => 2728,
                'city_id' => 31456,
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
        //
    }
}
