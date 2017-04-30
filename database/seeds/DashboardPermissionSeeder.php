<?php

use App\Permission;
use App\Role;
use App\Services\PermissionService;
use Illuminate\Database\Seeder;

class DashboardPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         /* 
         * Dashboard Permissions
         */
        $permissions = [
            ['dashboard:user', 'View user dashboard'],
            ['dashboard:vendor', 'View vendor dashboard'],
            ['dashboard:notice', 'View notice dashboard'],
            ['dashboard:finance', 'View finance dashboard'],
        ];

        // remove if permission exists
        foreach($permissions as $perm) {
            Permission::where('name', $perm[0])->forceDelete();
            $permission = PermissionService::create(new Permission, [
                'name' => $perm[0],
                'description' => $perm[1]
            ]);

            $admin = Role::whereName('admin')->first();
            $admin->permissions()->attach($permission->id);
        }
    }
}
