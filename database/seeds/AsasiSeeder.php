<?php

use App\Repositories\PermissionGroupsRepository;
use App\Repositories\PermissionsRepository;
use App\Repositories\UsersRepository;
use App\Repositories\RolesRepository;
use Illuminate\Database\Seeder;
use App\PermissionGroup;
use App\Permission;
use App\User;
use App\Role;

class AsasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->truncate();
        DB::table('role_user')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('user_logs')->truncate();
        DB::table('user_blacklists')->truncate();
        DB::table('password_resets')->truncate();
        DB::table('users')->truncate();

        $roles = [
            [
                'name'         => 'admin',
                'display_name' => 'Admin',
                'description'  => 'System Administrator. Should be able to do everything.',
            ],
        ];

        foreach ($roles as $roleData) {
            RolesRepository::create(new Role(), $roleData);
        }

        $users = [
            [
                'name'      => 'Super Admin',
                'email'     => 'admin@example.com',
                'password'  => 'admin123'
            ],
        ];

        foreach ($users as $userData) {
            $userData['password'] = app()->make('hash')->make($userData['password']);
            UsersRepository::create(new User(), $userData);
        }

        User::find(1)->attachRole(1);

        $permissions = [
            ['permission:list',     'List all permissions'],

            ['role:list',           'List all roles'],
            ['role:show',           'View role details'],
            ['role:create',         'Create new role'],
            ['role:update',         'Update exisiting role'],
            ['role:revisions',      'View role revisions'],
            ['role:delete',         'Delete exisiting role'],

            ['user:list',           'List all users'],
            ['user:show',           'View user details'],
            ['user:create',         'Create new user'],
            ['user:update',         'Update exisiting user'],
            ['user:revisions',      'View user revisions'],
            ['user:duplicate',      'Duplicate exisiting user'],
            ['user:delete',         'Delete existing user'],

            ['3', 'User:List', 'List Users'],
            ['3', 'User:Show', 'View User Details'],
            ['3', 'User:Create', 'Create New User'],
            ['3', 'User:Update', 'Update New User'],
            ['3', 'User:Duplicate', 'Duplicate Existing User'],
            ['3', 'User:Revisions', 'View User Revisions'],
            ['3', 'User:Delete', 'Delete Existing User'],
            ['3', 'User:Assume', 'Login As Another User'],
            ['3', 'User:Activate', 'Set User Active / Inactive'],
        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission(), [
                'name'          => $permissionData[0],
                'description'   => $permissionData[1],
            ]);
        }

        $permissionGroup = PermissionGroupsRepository::create(new PermissionGroup(), ['name' => 'User Blacklists']);

        $permissionGroup->permissions()->saveMany(array_map(function ($permissionData) {
            return new Permission($permissionData);
        }, [
            ['name' => 'UserBlacklist:List', 'display_name' => 'List User Blacklist'],
            ['name' => 'UserBlacklist:Show', 'display_name' => 'View User Blacklist Details'],
            ['name' => 'UserBlacklist:Create', 'display_name' => 'Create New User Blacklist'],
            ['name' => 'UserBlacklist:Update', 'display_name' => 'Update Existing User Blacklist'],
            ['name' => 'UserBlacklist:Duplicate', 'display_name' => 'Duplicate Existing User Blacklist'],
            ['name' => 'UserBlacklist:Revisions', 'display_name' => 'View Revisions For User Blacklist'],
            ['name' => 'UserBlacklist:Delete', 'display_name' => 'Delete Existing User Blacklist'],
        ]));
    }
}
