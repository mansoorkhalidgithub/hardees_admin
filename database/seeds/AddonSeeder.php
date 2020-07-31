<?php

use App\Addon;
use App\AddonType;
use App\AddonCategory;
use Illuminate\Database\Seeder;

class AddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AddonCategory::create(['name' => 'Soft Drinks']);
        AddonCategory::create(['name' => 'Sauces']);
		
		Addon::create(['name' => 'Mushroom']);
		Addon::create(['name' => 'Jalapeno']);
		Addon::create(['name' => 'Cheese']);
		Addon::create(['name' => 'Dip Suace']);
		
		AddonType::create(['addon_id' => 1, 'size' => 'Regular', 'price' => 30]);
		AddonType::create(['addon_id' => 2, 'size' => 'Regular', 'price' => 60]);
		AddonType::create(['addon_id' => 3, 'size' => 'Regular', 'price' => 80]);
		AddonType::create(['addon_id' => 4, 'size' => 'Regular', 'price' => 30]);
    }
}
