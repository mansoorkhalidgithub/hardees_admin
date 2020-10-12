<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SubAdminPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$subAdmin = Role::where(['name' => 'sub-admin'])->first();
		
        $subAdmin->givePermissionTo([
			'dashboard',
			'restaurants',
			'users',
			'menu',
			'menu-categories',
			'orders',
			'customers',
			'riders',
			'inbox',
			'app-sliders',
			'tax-setting',
			'manage-currency',
			'rider-request',
			'push-notifications',
			'earnings',
			'transactions'
		]); 
    }
}
