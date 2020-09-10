<?php

use App\Deal;
use App\DealItem;
use App\DealCategory;
use Illuminate\Database\Seeder;

class DealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DealCategory::create(['name' => 'Special Deals']);
		DealCategory::create(['name' => 'Ramadan Deals']);
		DealCategory::create(['name' => 'Eid Ul Fitr Deals']);
		
		Deal::create([
            'deal_category_id' => rand(1, 2),
            'restaurant_id' => 1,
            'title' => 'Ramadan Deal 1',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal1.png',
        ]);
		
		Deal::create([
            'deal_category_id' => rand(1, 2),
            'restaurant_id' => 1,
            'title' => 'Ramadan Deal 2',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal2.png',
        ]);
		
		Deal::create([
            'deal_category_id' => rand(1, 2),
            'restaurant_id' => 1,
            'title' => 'Ramadan Deal 3',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal3.png',
        ]);
		
		Deal::create([
            'deal_category_id' => rand(1, 2),
            'restaurant_id' => 1,
            'title' => 'Ramadan Deal 4',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal4.png',
        ]);
		
		
		
    }
}
