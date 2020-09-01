<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRegion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('name')->nullable();
			$table->integer('city_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('country_id')->nullable();
        });
		
		DB::table('regions')->insert(['name' => 'Lahore',]);
		DB::table('regions')->insert(['name' => 'Karachi',]);
		DB::table('regions')->insert(['name' => 'Islamabad',]);
		DB::table('regions')->insert(['name' => 'Peshawar',]);
		
		Schema::table('users', function (Blueprint $table) {
			
			$table->unsignedBigInteger('region_id')->nullable()->default(1);
			
			$table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
		});
		
		Schema::table('menu_categories', function (Blueprint $table) {
			
			$table->unsignedBigInteger('created_by')->nullable();
			
			$table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
		});
		
		Schema::table('orders', function (Blueprint $table) {
			
			$table->unsignedBigInteger('region_id')->nullable();
			
			$table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
		});
		
		DB::table('users')->where('id', 1)->update(['region_id' => 1]);

		DB::table('users')->insert([
            [
                'username' => 'admink',
                'email' => 'karachi@hardees.com',
                'password' => '$2y$10$68N8GubryLRmUzyvecqpWuAbix3gURUBs.OJdjF5laaFA2.2OiF96',
				'user_type' => 'admin',
				'region_id' => 2,
            ],
        ]);
		
		DB::table('users')->insert([
            [
                'username' => 'adminI',
                'email' => 'islamabad@hardees.com',
                'password' => '$2y$10$68N8GubryLRmUzyvecqpWuAbix3gURUBs.OJdjF5laaFA2.2OiF96',
				'user_type' => 'admin',
				'region_id' => 3,
            ],
        ]);
		
		DB::table('users')->insert([
            [
                'username' => 'adminP',
                'email' => 'peshawar@hardees.com',
                'password' => '$2y$10$68N8GubryLRmUzyvecqpWuAbix3gURUBs.OJdjF5laaFA2.2OiF96',
				'user_type' => 'admin',
				'region_id' => 4,
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
        Schema::dropIfExists('regions');
    }
}
