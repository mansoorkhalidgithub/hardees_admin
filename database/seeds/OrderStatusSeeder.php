<?php

use App\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::create(['name' => 'Pending', 'order_type_id' => 1]);
        OrderStatus::create(['name' => 'Accepted', 'order_type_id' => 1]);
        OrderStatus::create(['name' => 'Preparing', 'order_type_id' => 1]);
        OrderStatus::create(['name' => 'Ready', 'order_type_id' => 1]);
        OrderStatus::create(['name' => 'Out For Delivery', 'order_type_id' => 1]);
        OrderStatus::create(['name' => 'Completed', 'order_type_id' => 1]);
        OrderStatus::create(['name' => 'Rejected', 'order_type_id' => 1]);
    }
}
