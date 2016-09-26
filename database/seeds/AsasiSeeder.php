<?php

use App\Organization;
use App\Place;
use App\Permission;
use App\Role;
use App\User;
use App\Repositories\OrganizationsRepository;
use App\Repositories\PlacesRepository;
use App\Repositories\PermissionsRepository;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use Illuminate\Database\Seeder;

class AsasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organization_user')->truncate();
        DB::table('organizations')->truncate();
        DB::table('settings')->truncate();
        DB::table('uploads')->truncate();
        DB::table('permission_role')->truncate();
        DB::table('role_user')->truncate();
        DB::table('permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('user_logs')->truncate();
        DB::table('user_blacklists')->truncate();
        DB::table('password_resets')->truncate();
        DB::table('users')->truncate();
        DB::table('revisions')->truncate();
        DB::table('places')->truncate();

        $roles = [
            [
                'id'            => 1,
                'name'          => 'admin',
                'display_name'  => 'Admin',
                'description'   => 'System Administrator. Should be able to do everything.',
            ],
            [
                'id'            => 2,
                'name'          => 'vendor',
                'display_name'  => 'Vendor',
                'description'   => 'Vendor. Fixed role for vendor.',
            ],
            [
                'id'            => 3,
                'name'          => 'evaluator',
                'display_name'  => 'Evaluator',
                'description'   => 'Evaluator.',
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
                'verified'  => 1,
                'status'    => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $userData['password'] = app()->make('hash')->make($userData['password']);
            UsersRepository::create(new User(), $userData);
        }

        User::find(1)->roles()->attach(Role::first());

        $permissions = [
            ['access:admin',            'Access admin area'],
            ['access:report',           'Access reporting module'],
            ['access:vendor',           'Access vendor module'],

            ['permission:index',        'List all permissions'],

            ['role:index',              'List all roles'],
            ['role:show',               'View role details'],
            ['role:create',             'Create new role'],
            ['role:update',             'Update exisiting role'],
            ['role:delete',             'Delete exisiting role'],
            ['role:revisions',          'View role revisions'],
            ['role:logs',               'View role logs'],

            ['user:index',              'List all users'],
            ['user:show',               'View user details'],
            ['user:create',             'Create new user'],
            ['user:update',             'Update exisiting user'],
            ['user:duplicate',          'Duplicate exisiting user'],
            ['user:assume',             'Login as another user'],
            ['user:activate',           'Activate a user'],
            ['user:suspend',            'Suspend a user'],
            ['user:delete',             'Delete existing user'],
            ['user:revisions',          'View user revisions'],
            ['user:logs',               'View user logs'],

            ['user-blacklist:index',        'List all user blacklists'],
            ['user-blacklist:show',         'View blacklist details'],
            ['user-blacklist:create',       'Blacklist a user'],
            ['user-blacklist:update',       'Update user blacklist'],
            ['user-blacklist:duplicate',    'Duplicate a blacklist'],
            ['user-blacklist:delete',       'Delete existing user blacklist'],
            ['user-blacklist:revisions',    'List blacklist revisions'],
            ['user-blacklist:logs',         'View blacklist logs'],

            ['organization:index',      'List all organization'],
            ['organization:show',       'View organization details'],
            ['organization:create',     'Create new organization'],
            ['organization:update',     'Update exisiting organization'],
            ['organization:duplicate',  'Duplicate exisiting organization'],
            ['organization:activate',   'Activate an organization'],
            ['organization:deactivate', 'Deactivate an organization'],
            ['organization:suspend',    'Suspend an organization'],
            ['organization:delete',     'Delete exisitign organization'],
            ['organization:revisions',  'View organization revisions'],
            ['organization:logs',       'View organization logs'],

            ['place:index',             'List all places'],
            ['place:show',              'View place details'],
            ['place:create',            'Create new place'],
            ['place:update',            'Update existing place'],
            ['place:duplicate',         'Duplicate existing place'],
            ['place:activate',          'Activate existing place'],
            ['place:deactivate',        'Deactivate existing place'],
            ['place:delete',            'Delete existing place'],
            ['place:revisions',         'View place revisions'],
            ['place:logs',              'View place logs']
        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission(), [
                'name'          => $permissionData[0],
                'description'   => $permissionData[1],
            ]);
        }

        Role::first()->permissions()->sync(Permission::all()->lists('id')->toArray());

        OrganizationsRepository::create(new Organization, [
            'name' => 'Setiausaha Kerajaan Selangor',
            'short_name' => 'SUK SELANGOR'
        ]);

        $places = [
            ['Malaysia',        'MY',   'MAS',  'country',  null],     #1

            ['Johor',           null,   'JHR',  'state', 1],    #2
            ['Kedah',           null,   'KDH',  'state', 1],    #3
            ['Kelantan',        null,   'KEL',  'state', 1],    #4
            ['WP Kuala Lumpur', null,   'KUL',  'state', 1],    #5
            ['WP Labuan',       null,   'LBN',  'state', 1],    #6
            ['Melaka',          null,   'MEL',  'state', 1],    #7
            ['Negeri Sembilan', null,   'NEG',  'state', 1],    #8
            ['Pahang',          null,   'PHG',  'state', 1],    #9
            ['Pulau Pinang',    null,   'PNG',  'state', 1],    #10
            ['WP Putrajaya',    null,   'PUJ',  'state', 1],    #11
            ['Perak',           null,   'PRK',  'state', 1],    #12
            ['Perlis',          null,   'PER',  'state', 1],    #13
            ['Sabah',           null,   'SBH',  'state', 1],    #14
            ['Sarawak',         null,   'SWK',  'state', 1],    #15
            ['Selangor',        null,   'SEL',  'state', 1],    #16
            ['Terengganu',      null,   'TRG',  'state', 1],    #17

            ['Kuala Lumpur',    null,   null,   'city', 5],
            ['Shah Alam',       null,   null,   'city', 16]
        ];

        foreach($places as $place) {
            PlacesRepository::create(new Place(), [
                'name'      => $place[0],
                'code_2'    => $place[1],
                'code_3'    => $place[2],
                'type'      => $place[3],
                'parent_id' => $place[4]
            ]);
        }

    }
}
