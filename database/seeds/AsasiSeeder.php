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
        DB::table('revisions')->truncate();

        $roles = [
            [
                'name'          => 'admin',
                'display_name'  => 'Admin',
                'description'   => 'System Administrator. Should be able to do everything.',
            ],
        ];

        foreach ($roles as $roleData) {
            RolesRepository::create(new Role(), $roleData);
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
            UsersRepository::create(new User(), $userData);
        }

        User::find(1)->roles()->attach(Role::first());

        $permissions = [
            ['permission:index',        'List all permissions'],

            ['role:index',              'List all roles'],
            ['role:show',               'View role details'],
            ['role:create',             'Create new role'],
            ['role:update',             'Update exisiting role'],
            ['role:revisions',          'View role revisions'],
            ['role:delete',             'Delete exisiting role'],

            ['user:index',              'List all users'],
            ['user:show',               'View user details'],
            ['user:create',             'Create new user'],
            ['user:update',             'Update exisiting user'],
            ['user:revisions',          'View user revisions'],
            ['user:logs',               'View user logs'],
            ['user:duplicate',          'Duplicate exisiting user'],
            ['user:delete',             'Delete existing user'],
            ['user:assume',             'Login as another user'],
            ['user:activate',           'Activate a user'],
            ['user:suspend',            'Suspend a user'],

            ['user_blacklist:index',        'List all user blacklists'],
            ['user_blacklist:show',         'View blacklist details'],
            ['user_blacklist:create',       'Blacklist a user'],
            ['user_blacklist:update',       'Update user blacklist'],
            ['user_blacklist:duplicate',    'Duplicate a blacklist'],
            ['user_blacklist:revisions',    'List blacklist revisions'],
            ['user_blacklist:delete',       'Delete existing user blacklist']
        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission(), [
                'name'          => $permissionData[0],
                'description'   => $permissionData[1],
            ]);
        }

        Role::first()->permissions()->sync(Permission::all()->lists('id')->toArray());
    }
}
