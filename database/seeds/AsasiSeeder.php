<?php

use App\Services\PermissionService;
use App\Services\RoleService;
use App\Services\UserService;
use Illuminate\Database\Seeder;
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
        DB::table('user_histories')->truncate();
        DB::table('user_blacklists')->truncate();
        DB::table('password_resets')->truncate();
        DB::table('users')->truncate();
        DB::table('revisions')->truncate();

        $roles = [
            [
                'name'          => 'admin',
                'display_name'  => 'Admin',
                'description'   => 'System Administrator. Should be able to do everything.',
            ],
        ];

        foreach ($roles as $roleData) {
            RoleService::create(new Role(), $roleData);
        }

        $users = [
            [
                'name'      => 'Super Admin',
                'email'     => 'admin@example.com',
                'password'  => 'admin123',
                'status'    => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $userData['password'] = app()->make('hash')->make($userData['password']);
            UserService::create(new User(), $userData);
        }

        User::find(1)->roles()->attach(Role::first());

        $permissions = [
            ['permission:index',        'List all permissions'],
            ['permission:show',         'View permission details'],
            ['permission:create',       'Create new permission'],
            ['permission:update',       'Update existing permission'],
            ['permission:delete',       'Delete existing permission'],
            ['permission:revisions',    'View all permissions'],
            ['permission:histories',    'View all permissions'],

            ['role:index',              'List all roles'],
            ['role:show',               'View role details'],
            ['role:create',             'Create new role'],
            ['role:update',             'Update exisiting role'],
            ['role:delete',             'Delete exisiting role'],
            ['role:revisions',          'View role revisions'],
            ['role:histories',          'View role histories'],

            ['user:index',              'List all users'],
            ['user:show',               'View user details'],
            ['user:create',             'Create new user'],
            ['user:update',             'Update exisiting user'],
            ['user:revisions',          'View user revisions'],
            ['user:delete',             'Delete existing user'],
            ['user:restore',            'Restore deleted user'],
            ['user:revisions',          'View user revisions'],
            ['user:histories',          'View user histories'],
            ['user:duplicate',          'Duplicate exisiting user'],
            ['user:activate',           'Activate a user'],
            ['user:suspend',            'Suspend a user'],
            ['user:assume',             'Login as another user'],

            ['user-blacklist:index',        'List all user blacklists'],
            ['user-blacklist:show',         'View blacklist details'],
            ['user-blacklist:create',       'Blacklist a user'],
            ['user-blacklist:update',       'Update user blacklist'],
            ['user-blacklist:delete',       'Delete existing user blacklist']
            ['user-blacklist:duplicate',    'Duplicate a blacklist'],
            ['user-blacklist:revisions',    'View blacklist revisions'],
            ['user-blacklist:histories',    'View blacklist histories'],
        ];

        foreach ($permissions as $permissionData) {
            PermissionService::create(new Permission(), [
                'name'          => $permissionData[0],
                'description'   => $permissionData[1],
            ]);
        }

        Role::first()->permissions()->sync(Permission::all()->pluck('id')->toArray());
    }
}
