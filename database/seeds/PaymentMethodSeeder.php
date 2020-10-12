<?php

use App\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentMethod::create(['name' => 'Cash On Delivery (COD)']);
        PaymentMethod::create(['name' => 'Credit / Debit Cards']);
    }
}
