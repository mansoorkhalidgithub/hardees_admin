<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('username', 100)->nullable();
            $table->string('email', 191)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
			$table->date('dob')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('password')->nullable();
            $table->string('user_type')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('profile_picture')->nullable();
            $table->string('address')->nullable();
            $table->string('app_version', 50)->nullable();
            $table->string('language_code', 50)->nullable();
            $table->integer('city_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->string('cnic')->nullable();
            $table->date('cnic_expire_date')->nullable();
			$table->string('device_type', 100)->nullable();
			$table->string('device_name', 100)->nullable();
            $table->string('device_id', 100)->nullable();
			$table->text('device_token')->nullable();
            $table->string('api_token', 80)->unique()->nullable()->default(null);
			$table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
		
		DB::table('users')->insert([
            [
                'username' => 'admin',
                'email' => 'lahore@hardees.com',
                'password' => '$2y$10$68N8GubryLRmUzyvecqpWuAbix3gURUBs.OJdjF5laaFA2.2OiF96',
				'user_type' => 'admin',
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
        Schema::dropIfExists('users');
    }
}
