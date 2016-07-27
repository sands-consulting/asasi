<?php

use App\Vendor;
use App\VendorType;
use App\Permission;
use App\Repositories\VendorsRepository;
use App\Repositories\VendorTypesRepository;
use App\Repositories\PermissionsRepository;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendors')->truncate();

        $permissions = [
            ['vendors:index',                  'List all vendors'],
            ['vendors:show',                   'View a vendors'],
            ['vendors:create',                 'Create new vendors'],
            ['vendors:update',                 'Update existing vendors'],
            ['vendors:delete',                 'Delete exisiting vendors'],

            ['vendor_types:index',         'List all vendor types'],
            ['vendor_types:show',          'View a vendor types'],
            ['vendor_types:create',        'Create new vendor category'],
            ['vendor_types:update',        'Update existing vendor category'],
            ['vendor_types:delete',        'Delete existing vendor category'],

        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission(), [
                'name'          => $permissionData[0],
                'description'   => $permissionData[1],
            ]);
        }

        $vendor_types = [
            [
                'name' => 'Vendors'
            ]
        ];

        foreach($vendor_types as $vendor_type)
        {
            VendorTypesRepository::create(new VendorType, $vendor_type);
        }

        // VendorsRepository::create();
    }
}
