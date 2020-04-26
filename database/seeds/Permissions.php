<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Permissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
		
		// Reset cached roles and permissions
		
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        //create permissions
		
		Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'restaurants']);
        Permission::create(['name' => 'users']);
        Permission::create(['name' => 'menu']);
        Permission::create(['name' => 'menu_categories']);
		Permission::create(['name' => 'orders']);
		Permission::create(['name' => 'customers']);
        Permission::create(['name' => 'riders']);
        Permission::create(['name' => 'inbox']);
        Permission::create(['name' => 'app-sliders']);
        Permission::create(['name' => 'tax-setting']);
        Permission::create(['name' => 'manage-currency']);
        Permission::create(['name' => 'rider-request']);
        Permission::create(['name' => 'push-notifications']);
        Permission::create(['name' => 'earnings']);
		Permission::create(['name' => 'transactions']);
        Permission::create(['name' => 'change-password']);
    }
}
