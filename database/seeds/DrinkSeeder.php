<?php

use App\Drink;
use Illuminate\Database\Seeder;

class DrinkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Drink::create(['name' => 'Coke', 'price' => 100]);
		Drink::create(['name' => 'Sprite', 'price' => 100]);
		Drink::create(['name' => 'Fanta', 'price' => 100]);
		Drink::create(['name' => 'Chocolate Shake', 'price' => 270]);
		Drink::create(['name' => 'Strawberry Shake', 'price' => 270]);
		Drink::create(['name' => 'Vanilla Shake', 'price' => 270]);
		Drink::create(['name' => 'Coffee Shake', 'price' => 270]);
    }
}
