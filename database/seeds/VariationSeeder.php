<?php

use App\Side;
use App\Extra;
use App\Drink;
use App\Variation;
use Illuminate\Database\Seeder;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Variation::create(['menu_item_id' => 1, 'name' => 'Ala Carte', 'price' => 790]);
        Variation::create(['menu_item_id' => 1, 'name' => 'With Drink', 'price' => 890]);
        Variation::create(['menu_item_id' => 1, 'name' => 'Regular Combo', 'price' => 990]);
        Variation::create(['menu_item_id' => 1, 'name' => 'Medium Combo', 'price' => 1090]);
        Variation::create(['menu_item_id' => 1, 'name' => 'Large Combo', 'price' => 1190]);
        
		Side::create(['menu_item_id' => 1, 'variation_id' => 3, 'name' => 'Natural Cut Fries', 'price' => 30]);
		Side::create(['menu_item_id' => 1, 'variation_id' => 3, 'name' => 'Onion Rings', 'price' => 80]);
		Side::create(['menu_item_id' => 1, 'variation_id' => 3, 'name' => 'Curly Fries', 'price' => 80]);
		
		Side::create(['menu_item_id' => 1, 'variation_id' => 4, 'name' => 'Natural Cut Fries', 'price' => 30]);
		Side::create(['menu_item_id' => 1, 'variation_id' => 4, 'name' => 'Onion Rings', 'price' => 80]);
		Side::create(['menu_item_id' => 1, 'variation_id' => 4, 'name' => 'Curly Fries', 'price' => 80]);
		
		Side::create(['menu_item_id' => 1, 'variation_id' => 5, 'name' => 'Natural Cut Fries', 'price' => 30]);
		Side::create(['menu_item_id' => 1, 'variation_id' => 5, 'name' => 'Onion Rings', 'price' => 80]);
		Side::create(['menu_item_id' => 1, 'variation_id' => 5, 'name' => 'Curly Fries', 'price' => 80]);
		
		Extra::create(['menu_item_id' => 1, 'variation_id' => 5, 'name' => 'Large Meat', 'price' => 270]);
    }
}
