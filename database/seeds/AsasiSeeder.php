<?php

use App\Organization;
use App\Place;
use App\Role;
use App\TaxCode;
use App\User;
use App\Services\OrganizationService;
use App\Services\PlaceService;
use App\Services\TaxCodeService;
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
        DB::table('addresses')->truncate();
        DB::table('organization_user')->truncate();
        DB::table('organizations')->truncate();
        DB::table('uploads')->truncate();
        DB::table('user_histories')->truncate();
        DB::table('user_blacklists')->truncate();
        DB::table('password_resets')->truncate();
        DB::table('revisions')->truncate();
        DB::table('places')->truncate();
        DB::table('users')->truncate();
        DB::table('tax_codes')->truncate();

        OrganizationService::create(new Organization, [
            'name' => 'ACME Inc.',
            'short_name' => 'ACME'
        ]);

        $users = [
            [
                'name'      => 'Super Admin',
                'email'     => 'admin@example.com',
                'password'  => app()->make('hash')->make('admin123'),
                'status'    => 'active',
                'roles'     => [
                    'admin'
                ]
            ]
        ];

        foreach($users as $userData)
        {
            $roles  = $userData['roles'];
            unset($userData['roles']);

            $user = UserService::create(new User(), $userData);
            $user->roles()->sync(Role::whereIn('name', $roles)->pluck('id')->toArray());
            $user->organizations()->attach(Organization::first());
        }

        $taxes = [
            [
                'name' => 'Standard Rated',
                'code' => 'SR',
                'rate' => 6.00,
                'status' => 'active'
            ],
            [
                'name' => 'Zero Rated',
                'code' => 'ZR',
                'rate' => 0.00,
                'status' => 'active'
            ],
            [
                'name' => 'Exempt',
                'code' => 'EX',
                'rate' => 0.00,
                'status' => 'active'
            ]
        ];

        foreach($taxes as $tax)
        {
            TaxCodeService::create(new TaxCode, $tax);
        }
    }
}
