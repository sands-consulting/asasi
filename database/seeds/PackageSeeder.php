<?php

use App\Package;
use App\Permission;
use App\Subscription;
use App\Repositories\PackagesRepository;
use App\Repositories\PermissionsRepository;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->truncate();

        $permissions = [
            ['package:index', 'List all packages'],
            ['package:show', 'View a package'],
            ['package:create', 'Create new package'],
            ['package:update', 'Update existing package'],
            ['package:duplicate', 'Duplicate existing package'],
            ['package:activate', 'Activate existing package'],
            ['package:deactivate', 'Deactivate existing package'],
            ['package:delete', 'Delete existing package'],
            ['package:revisions', 'View package revisions'],
            ['package:logs', 'View package logs']
        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission(), [
                'name'        => $permissionData[0],
                'description' => $permissionData[1],
            ]);
        }

        PackagesRepository::create(new Package(), [
            'name' => 'Package 1',
            'validity_type' => 'validity type',
            'validity_quantity' => 'validity quantity',
            'fee_amount' =>  '250.00',
            'fee_tax_code' => 'GST',
            'fee_tax_rate' => '6',
            'status' => 'active'
        ]);
    }
}
