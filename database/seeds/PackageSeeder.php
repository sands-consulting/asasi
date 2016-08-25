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

        $packageData = [
            [
                'name' => 'Package 1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo quam, tempore at! Harum quas, suscipit. Quis aliquid officia necessitatibus, unde fugiat sapiente libero vel. Vel, provident, sapiente. Eos, possimus odio!',
                'validity_type' => 'months',
                'validity_quantity' => '6',
                'fee_amount' =>  '50.00',
                'fee_tax_code' => 'GST',
                'fee_tax_rate' => '6',
                'status' => 'active'
            ],
            [
                'name' => 'Package 2',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo quam, tempore at! Harum quas, suscipit. Quis aliquid officia necessitatibus, unde fugiat sapiente libero vel. Vel, provident, sapiente. Eos, possimus odio!',
                'validity_type' => 'months',
                'validity_quantity' => '12',
                'fee_amount' =>  '150.00',
                'fee_tax_code' => 'GST',
                'fee_tax_rate' => '6',
                'status' => 'active'
            ],
            [
                'name' => 'Package 3',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo quam, tempore at! Harum quas, suscipit. Quis aliquid officia necessitatibus, unde fugiat sapiente libero vel. Vel, provident, sapiente. Eos, possimus odio!',
                'validity_type' => 'years',
                'validity_quantity' => '2',
                'fee_amount' =>  '250.00',
                'fee_tax_code' => 'GST',
                'fee_tax_rate' => '6',
                'status' => 'active'
            ]
        ];

        foreach ($packageData as $package) {
            PackagesRepository::create(new Package(), $package);
        }
    }
}
