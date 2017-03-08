<?php

use App\Organization;
use App\Place;
use App\Permission;
use App\Role;
use App\User;
use App\Services\OrganizationService;
use App\Services\PlaceService;
use App\Services\PermissionService;
use App\Services\RoleService;
use App\Services\UserService;
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
        DB::table('roles')->truncate();
        DB::table('user_histories')->truncate();
        DB::table('user_blacklists')->truncate();
        DB::table('password_resets')->truncate();
        DB::table('users')->truncate();
        DB::table('revisions')->truncate();
        DB::table('places')->truncate();



        $permissions = [

        ];

        foreach ($permissions as $permissionData) {
            PermissionService::create(new Permission(), [
                'name'          => $permissionData[0],
                'description'   => $permissionData[1],
            ]);
        }

        Role::first()->permissions()->sync(Permission::whereNotIn('name', ['access:vendor'])->pluck('id')->toArray());

        OrganizationService::create(new Organization, [
            'name' => 'ACME Inc.',
            'short_name' => 'ACME'
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
            PlaceService::create(new Place(), [
                'name'      => $place[0],
                'code_2'    => $place[1],
                'code_3'    => $place[2],
                'type'      => $place[3],
                'parent_id' => $place[4]
            ]);
        }
    }
}
