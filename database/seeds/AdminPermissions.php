<?php

use App\Auth;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$admin = Role::where(['name' => 'admin'])->first();
		
		/* $permissions = Permission::all();
		
		$permissionNames = $permissions->pluck('name');*/
		
		$admin->givePermissionTo([
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
		
		$appAdmin = Auth::where('id', 1)->first();
		
		$appAdmin->assignRole('admin');
    }
}
