<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('restaurant_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->date('dob')->nullable();
            $table->string('username', 100)->nullable();
            $table->string('email', 191)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('eStatus')->default(10);
            $table->string('password')->nullable();
            $table->string('api_token', 80)->unique()->nullable()->default(null);
            $table->rememberToken();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('address')->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('cnic')->nullable();
            $table->date('cnic_expire_date')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('auth')->onDelete('cascade');
            $table->foreign('restaurant_id')->references('id')->on('restaurants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riders');
    }
}
