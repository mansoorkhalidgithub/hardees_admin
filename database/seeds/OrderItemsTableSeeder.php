<?php

use Illuminate\Database\Seeder;

class OrderItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_items')->insert([
            [
                'order_id' => 2,
                'menu_item_id' => 1,
                'item_price' => 100,
                'item_quantity' => 2,
            ],
        ]);

        DB::table('order_items')->insert([
            [
                'order_id' => 2,
                'menu_item_id' => 2,
                'item_price' => 100,
                'item_quantity' => 2,
            ],
        ]);

        DB::table('order_items')->insert([
            [
                'order_id' => 3,
                'menu_item_id' => 1,
                'item_price' => 100,
                'item_quantity' => 2,
            ],
        ]);
        DB::table('order_items')->insert([
            [
                'order_id' => 3,
                'menu_item_id' => 1,
                'item_price' => 100,
                'item_quantity' => 2,
            ],
        ]);
        DB::table('order_items')->insert([
            [
                'order_id' => 6,
                'menu_item_id' => 1,
                'item_price' => 100,
                'item_quantity' => 2,
            ],
        ]);
        DB::table('order_items')->insert([
            [
                'order_id' => 6,
                'menu_item_id' => 1,
                'item_price' => 100,
                'item_quantity' => 2,
            ],
        ]);
        DB::table('order_items')->insert([
            [
                'order_id' => 6,
                'menu_item_id' => 1,
                'item_price' => 100,
                'item_quantity' => 2,
            ],
        ]);
        DB::table('order_items')->insert([
            [
                'order_id' => 5,
                'menu_item_id' => 1,
                'item_price' => 100,
                'item_quantity' => 2,
            ],
        ]);
        DB::table('order_items')->insert([
            [
                'order_id' => 5,
                'menu_item_id' => 1,
                'item_price' => 100,
                'item_quantity' => 2,
            ],
        ]);
        DB::table('order_items')->insert([
            [
                'order_id' => 6,
                'menu_item_id' => 1,
                'item_price' => 100,
                'item_quantity' => 2,
            ],
        ]);
        DB::table('order_items')->insert([
            [
                'order_id' => 6,
                'menu_item_id' => 1,
                'item_price' => 100,
                'item_quantity' => 2,
            ],
        ]);
    }
}
