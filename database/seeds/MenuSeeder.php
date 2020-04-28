<?php

use App\MenuCategory;
use App\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuCategory::create([
            'name' => 'Burger',
        ]);
		
		MenuItem::create([
            'name' => 'Zinger Burger',
            'menu_category_id' => 1,
            'created_by' => 1,
            'restaurant_id' => 1,
            'quantity' => 10,
            'price' => 10,
            'weight' => 350,
            'discount' => 50,
            'is_favourite' => 1,
            'image' => 'uploads/menu_items/burger1.png',
            'ingredients' => serialize(['Egg', 'Mustard', 'Sauce', 'Onion', 'Garlic', 'Medium Groung Beaf']),
        ]);
		
		MenuItem::create([
            'name' => 'King Size Burger',
            'menu_category_id' => 1,
            'created_by' => 1,
            'restaurant_id' => 1,
            'quantity' => 10,
            'price' => 10,
            'weight' => 350,
            'discount' => 50,
            'is_favourite' => 0,
            'image' => 'uploads/menu_items/burger2.png',
            'ingredients' => serialize(['Egg', 'Mustard', 'Sauce', 'Onion', 'Garlic', 'Medium Groung Beaf']),
        ]);
		
		MenuItem::create([
            'name' => 'Chicken Cheese Burger',
            'menu_category_id' => 1,
            'created_by' => 1,
            'restaurant_id' => 1,
            'quantity' => 10,
            'price' => 10,
            'weight' => 350,
            'discount' => 50,
            'is_favourite' => 1,
            'image' => 'uploads/menu_items/burger3.png',
            'ingredients' => serialize(['Egg', 'Mustard', 'Sauce', 'Onion', 'Garlic', 'Medium Groung Beaf']),
        ]);
		
		MenuItem::create([
            'name' => 'Petty Burger',
            'menu_category_id' => 1,
            'created_by' => 1,
            'restaurant_id' => 1,
            'quantity' => 10,
            'price' => 10,
            'weight' => 350,
            'discount' => 50,
            'is_favourite' => 1,
            'image' => 'uploads/menu_items/burger4.png',
            'ingredients' => serialize(['Egg', 'Mustard', 'Sauce', 'Onion', 'Garlic', 'Medium Groung Beaf']),
        ]);
		
		MenuItem::create([
            'name' => 'Cheese Burger',
            'menu_category_id' => 1,
            'created_by' => 1,
            'restaurant_id' => 1,
            'quantity' => 10,
            'price' => 10,
            'weight' => 350,
            'discount' => 50,
            'is_favourite' => 1,
            'image' => 'uploads/menu_items/burger5.png',
            'ingredients' => serialize(['Egg', 'Mustard', 'Sauce', 'Onion', 'Garlic', 'Medium Groung Beaf']),
        ]);
		
		MenuItem::create([
            'name' => 'Beef Burger',
            'menu_category_id' => 1,
            'created_by' => 1,
            'restaurant_id' => 1,
            'quantity' => 10,
            'price' => 10,
            'weight' => 350,
            'discount' => 50,
            'is_favourite' => 0,
            'image' => 'uploads/menu_items/burger5.png',
            'ingredients' => serialize(['Egg', 'Mustard', 'Sauce', 'Onion', 'Garlic', 'Medium Groung Beaf']),
        ]);
		
		MenuItem::create([
            'name' => 'Black Been Burger',
            'menu_category_id' => 1,
            'created_by' => 1,
            'restaurant_id' => 1,
            'quantity' => 10,
            'price' => 10,
            'weight' => 350,
            'discount' => 50,
            'is_favourite' => 0,
            'image' => 'uploads/menu_items/burger5.png',
            'ingredients' => serialize(['Egg', 'Mustard', 'Sauce', 'Onion', 'Garlic', 'Medium Groung Beaf']),
        ]);
    }
}
