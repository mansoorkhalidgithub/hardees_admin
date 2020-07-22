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
        DealCategory::create(['name' => 'Regular Deals', 'status' => 1]);
        DealCategory::create(['name' => 'Special Deals']);
		DealCategory::create(['name' => 'Ramadan Deals']);
		DealCategory::create(['name' => 'Eid Ul Fitr Deals']);
		
		Deal::create([
            'deal_category_id' => 1,
            'restaurant_id' => 1,
            'title' => 'Deal 1',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal1.png',
        ]);
		
		Deal::create([
            'deal_category_id' => 1,
            'restaurant_id' => 1,
            'title' => 'Deal 2',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal2.png',
        ]);
		
		Deal::create([
            'deal_category_id' => 1,
            'restaurant_id' => 1,
            'title' => 'Deal 3',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal3.png',
        ]);
		
		Deal::create([
            'deal_category_id' => 1,
            'restaurant_id' => 1,
            'title' => 'Deal 4',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal4.png',
        ]);
		
		Deal::create([
            'deal_category_id' => 1,
            'restaurant_id' => 1,
            'title' => 'Deal 5',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal1.png',
        ]);
		
		Deal::create([
            'deal_category_id' => 1,
            'restaurant_id' => 1,
            'title' => 'Deal 6',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal2.png',
        ]);
		
		Deal::create([
            'deal_category_id' => 1,
            'restaurant_id' => 1,
            'title' => 'Deal 7',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal3.png',
        ]);
		
		Deal::create([
            'deal_category_id' => 1,
            'restaurant_id' => 1,
            'title' => 'Deal 8',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal4.png',
        ]);
		
		Deal::create([
            'deal_category_id' => 1,
            'restaurant_id' => 1,
            'title' => 'Deal 9',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal4.png',
        ]);
		
		Deal::create([
            'deal_category_id' => 1,
            'restaurant_id' => 1,
            'title' => 'Deal 10',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal4.png',
        ]);
		
		Deal::create([
            'deal_category_id' => 1,
            'restaurant_id' => 1,
            'title' => 'Deal 11',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal4.png',
        ]);
		
		Deal::create([
            'deal_category_id' => 1,
            'restaurant_id' => 1,
            'title' => 'Deal 12',
            'status' => 1,
            'payable_price' => 550,
            'calculated_price' => 1100,
            'image' => 'uploads/deals/deal4.png',
        ]);
		
		
    }
}
