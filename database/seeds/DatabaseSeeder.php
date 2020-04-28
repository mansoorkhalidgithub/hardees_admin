<?php

use App\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		factory(Category::class, 10)->create();
        $this->call([
			Permissions::class,
            Roles::class,
            AdminPermissions::class,
            SubAdminPermissions::class,
            AuthPermissions::class,
            PaymentMethodSeeder::class,
            RestaurantSeeder::class,
            MenuSeeder::class,
        ]);
    }
}
