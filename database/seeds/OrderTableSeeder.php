<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            [
                'restaurant_id' => 1,
                'user_id' => 1,
                // 'rider_id' => 1,
                'order_type_id' => 1,
                'delivery_charges' => '75',
                'discount' => '0',
                'tax' => '0',
                'sub_total' => '750',
                'total' => '750',
                'payment_method_id' => 1,
                'status' => 10,
                'latitude' => 30.0582445,
                'longitude' => 72.6845644,
                'customer_address' => 'lahore'
            ],
        ]);

        DB::table('orders')->insert([
            [
                'restaurant_id' => 2,
                'user_id' => 1,
                // 'rider_id' => 8,
                'order_type_id' => 1,
                'delivery_charges' => '75',
                'discount' => '0',
                'tax' => '0',
                'sub_total' => '750',
                'total' => '750',
                'payment_method_id' => 1,
                'status' => 10,
                'latitude' => 30.0582445,
                'longitude' => 72.6845644,
                'customer_address' => 'lahore'
            ],
        ]);

        DB::table('orders')->insert([
            [
                'restaurant_id' => 4,
                'user_id' => 1,
                // 'rider_id' => 3,
                'order_type_id' => 1,
                'delivery_charges' => '75',
                'discount' => '0',
                'tax' => '0',
                'sub_total' => '750',
                'total' => '750',
                'payment_method_id' => 1,
                'status' => 10,
                'latitude' => 30.0582445,
                'longitude' => 72.6845644,
                'customer_address' => 'lahore'
            ],
        ]);

        DB::table('orders')->insert([
            [
                'restaurant_id' => 1,
                'user_id' => 1,
                // 'rider_id' => 1,
                'order_type_id' => 1,
                'delivery_charges' => '75',
                'discount' => '0',
                'tax' => '0',
                'sub_total' => '750',
                'total' => '750',
                'payment_method_id' => 1,
                'status' => 10,
                'latitude' => 30.0582445,
                'longitude' => 72.6845644,
                'customer_address' => 'lahore'
            ],
        ]);

        DB::table('orders')->insert([
            [
                'restaurant_id' => 5,
                'user_id' => 1,
                // 'rider_id' => 5,
                'order_type_id' => 1,
                'delivery_charges' => '75',
                'discount' => '0',
                'tax' => '0',
                'sub_total' => '750',
                'total' => '750',
                'payment_method_id' => 1,
                'status' => 10,
                'latitude' => 30.0582445,
                'longitude' => 72.6845644,
                'customer_address' => 'lahore'
            ],
        ]);
    }
}
