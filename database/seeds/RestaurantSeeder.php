<?php

use App\Restaurant;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Restaurant::create([
            'created_by' => '1',
            'name' => 'Hardee’s, DHA, Lahore',
            'email' => 'email@hardees.com',
            'tags' => 's:8:"j1 j2 j3";',
            'status' => 1,
            'address' => 'Hardee’s, DHA, Lahore, Pakistan',
            'latitude' => '31.4752032',
            'longitude' => '74.3791952',
            'min_order_price' => 450,
            'expense_type' => '1',
            'currency_symbol' => 're',
            'currency_name' => 'rupees',
            'delivery_type' => 'home_delivery',
            'delivery_charges' => 100,
            'delivery_charges_km' => '1',
            'device_type' => 'Tab',
            'device_name' => 'tablet',
            'device_token' => 'eRhDNk81T0mzxvrb4QHcDf:APA91bFvx0s-FAv_nDiBq4ghg9HvOVS9f8Xzw8J9tI99sLtXNCSKEj7_2Z3rAEFPMsPKnus90QHKT7isW3FFwAxcknbErnUehgkPYsa7-r2gZfsLA0BDWh19K4mtO1gj4IMVMyDlKmDA',
            'payment_methods' => '1,2',
            'category_id' => 1,
            'delivery_time' => 45,
            'logo' => 'uploads/logo/U6RIgV3D1s.jpg',
            'thumbnail' => 'uploads/cover/B4iFYJEVr5.jpeg',
            'contact_number' => '(042) 111 200 400',
            'deleted_at' => null,
        ]);

        Restaurant::create([
            'created_by' => '1',
            'name' => 'Hardees Restaurant- MM Alam Road',
            'email' => 'email1@hardees.com',
            'tags' => 's:8:"j1 j2 j3";',
            'status' => 1,
            'address' => 'Hardees Restaurant- MM Alam Road, MM Alam Road, Lahore, Pakistan',
            'latitude' => '31.5095003',
            'longitude' => '74.3507187',
            'min_order_price' => 450,
            'expense_type' => '1',
            'currency_symbol' => 're',
            'currency_name' => 'rupees',
            'delivery_type' => 'home_delivery',
            'delivery_charges' => 70,
            'delivery_charges_km' => '1',
            'device_type' => 'Tab',
            'device_name' => 'tablet',
            'device_token' => 'eRhDNk81T0mzxvrb4QHcDf:APA91bFvx0s-FAv_nDiBq4ghg9HvOVS9f8Xzw8J9tI99sLtXNCSKEj7_2Z3rAEFPMsPKnus90QHKT7isW3FFwAxcknbErnUehgkPYsa7-r2gZfsLA0BDWh19K4mtO1gj4IMVMyDlKmDA',
            'payment_methods' => '1,2',
            'category_id' => 1,
            'delivery_time' => 55,
            'logo' => 'uploads/logo/U6RIgV3D1s.jpg',
            'thumbnail' => 'uploads/cover/B4iFYJEVr5.jpeg',
            'contact_number' => '(042) 111 200 400',
            'deleted_at' => null,
        ]);

        Restaurant::create([
            'created_by' => '1',
            'name' => "Hardee's, Emporium",
            'email' => 'email2@hardees.com',
            'tags' => 's:8:"j1 j2 j3";',
            'status' => 1,
            'address' => "Hardee's, Emporium, Abdul Haque Road, Lahore, Pakistan",
            'latitude' => '31.4666556',
            'longitude' => '74.26613110000001',
            'min_order_price' => 450,
            'expense_type' => '1',
            'currency_symbol' => 're',
            'currency_name' => 'rupees',
            'delivery_type' => 'home_delivery',
            'delivery_charges' => 50,
            'delivery_charges_km' => '1',
            'device_type' => 'Tab',
            'device_name' => 'tablet',
            'device_token' => 'eRhDNk81T0mzxvrb4QHcDf:APA91bFvx0s-FAv_nDiBq4ghg9HvOVS9f8Xzw8J9tI99sLtXNCSKEj7_2Z3rAEFPMsPKnus90QHKT7isW3FFwAxcknbErnUehgkPYsa7-r2gZfsLA0BDWh19K4mtO1gj4IMVMyDlKmDA',
            'payment_methods' => '1,2',
            'category_id' => 1,
            'delivery_time' => 50,
            'logo' => 'uploads/logo/U6RIgV3D1s.jpg',
            'thumbnail' => 'uploads/cover/B4iFYJEVr5.jpeg',
            'contact_number' => '(042) 111 200 400',
            'deleted_at' => null,
        ]);

        Restaurant::create([
            'created_by' => '1',
            'name' => "Hardee's, Multan Road",
            'email' => 'email4@hardees.com',
            'tags' => 's:8:"j1 j2 j3";',
            'status' => 1,
            'address' => "Hardee's, Multan Road, Lahore, Pakistan",
            'latitude' => '31.4680449',
            'longitude' => '74.2324129',
            'min_order_price' => 450,
            'expense_type' => '1',
            'currency_symbol' => 're',
            'currency_name' => 'rupees',
            'delivery_type' => 'home_delivery',
            'delivery_charges' => 50,
            'delivery_charges_km' => '1',
            'device_type' => 'Tab',
            'device_name' => 'tablet',
            'device_token' => 'eRhDNk81T0mzxvrb4QHcDf:APA91bFvx0s-FAv_nDiBq4ghg9HvOVS9f8Xzw8J9tI99sLtXNCSKEj7_2Z3rAEFPMsPKnus90QHKT7isW3FFwAxcknbErnUehgkPYsa7-r2gZfsLA0BDWh19K4mtO1gj4IMVMyDlKmDA',
            'payment_methods' => '1,2',
            'category_id' => 1,
            'delivery_time' => 50,
            'logo' => 'uploads/logo/U6RIgV3D1s.jpg',
            'thumbnail' => 'uploads/cover/B4iFYJEVr5.jpeg',
            'contact_number' => '(042) 111 200 400',
            'deleted_at' => null,
        ]);

        Restaurant::create([
            'created_by' => '1',
            'name' => "Hardee's, 2 Gulberg",
            'email' => 'email5@hardees.com',
            'tags' => 's:8:"j1 j2 j3";',
            'status' => 1,
            'address' => "Hardee's, 2 Gulberg, Lahore, Pakistan",
            'latitude' => '31.5096962',
            'longitude' => '74.35063840000001',
            'min_order_price' => 450,
            'expense_type' => '1',
            'currency_symbol' => 're',
            'currency_name' => 'rupees',
            'delivery_type' => 'home_delivery',
            'delivery_charges' => 50,
            'delivery_charges_km' => '1',
            'device_type' => 'Tab',
            'device_name' => 'tablet',
            'device_token' => 'eRhDNk81T0mzxvrb4QHcDf:APA91bFvx0s-FAv_nDiBq4ghg9HvOVS9f8Xzw8J9tI99sLtXNCSKEj7_2Z3rAEFPMsPKnus90QHKT7isW3FFwAxcknbErnUehgkPYsa7-r2gZfsLA0BDWh19K4mtO1gj4IMVMyDlKmDA',
            'payment_methods' => '1,2',
            'category_id' => 1,
            'delivery_time' => 50,
            'logo' => 'uploads/logo/U6RIgV3D1s.jpg',
            'thumbnail' => 'uploads/cover/B4iFYJEVr5.jpeg',
            'contact_number' => '(042) 111 200 400',
            'deleted_at' => null,
        ]);
		
		Restaurant::create([
            'created_by' => 2,
            'name' => 'Hardee’s, Karachi',
            'email' => 'emailk@hardees.com',
            'tags' => 's:8:"j1 j2 j3";',
            'status' => 1,
            'address' => 'Hardee’s, Karachi',
            'latitude' => '31.4752032',
            'longitude' => '74.3791952',
            'min_order_price' => 450,
            'expense_type' => '1',
            'currency_symbol' => 're',
            'currency_name' => 'rupees',
            'delivery_type' => 'home_delivery',
            'delivery_charges' => 100,
            'delivery_charges_km' => '1',
            'device_type' => 'Tab',
            'device_name' => 'tablet',
            'device_token' => 'eRhDNk81T0mzxvrb4QHcDf:APA91bFvx0s-FAv_nDiBq4ghg9HvOVS9f8Xzw8J9tI99sLtXNCSKEj7_2Z3rAEFPMsPKnus90QHKT7isW3FFwAxcknbErnUehgkPYsa7-r2gZfsLA0BDWh19K4mtO1gj4IMVMyDlKmDA',
            'payment_methods' => '1,2',
            'category_id' => 1,
            'delivery_time' => 45,
            'logo' => 'uploads/logo/U6RIgV3D1s.jpg',
            'thumbnail' => 'uploads/cover/B4iFYJEVr5.jpeg',
            'contact_number' => '(042) 111 200 400',
            'deleted_at' => null,
        ]);
    }
}
