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
		
		Addon::create(['addon_category_id' => 1, 'name' => 'Coke', 'image' => 'uploads/addons/coke.png']);
		Addon::create(['addon_category_id' => 2, 'name' => 'Green Sauce', 'image' => 'uploads/addons/sauce.jpg']);
		Addon::create(['addon_category_id' => 2, 'name' => 'Tomato Sauce', 'image' => 'uploads/addons/sauce.jpg']);
		Addon::create(['addon_category_id' => 2, 'name' => 'White Sauce', 'image' => 'uploads/addons/sauce.jpg']);
		
		AddonType::create(['addon_id' => 1, 'size' => 'Regular', 'price' => 30]);
		AddonType::create(['addon_id' => 1, 'size' => 'Half Litre', 'price' => 60]);
		AddonType::create(['addon_id' => 1, 'size' => '1.5 Litre', 'price' => 80]);
		AddonType::create(['addon_id' => 2, 'size' => 'Regular', 'price' => 30]);
		AddonType::create(['addon_id' => 3, 'size' => 'Regular', 'price' => 30]);
		AddonType::create(['addon_id' => 4, 'size' => 'Regular', 'price' => 30]);
    }
}
