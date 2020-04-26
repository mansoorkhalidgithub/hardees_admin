<?php

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
        $this->call([
			Permissions::class,
            Roles::class,
            AdminPermissions::class,
            SubAdminPermissions::class,
            AuthPermissions::class,
        ]);
    }
}
