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
            ['vendor:index',                  'List all vendors'],
            ['vendor:show',                   'View a vendors'],
            ['vendor:create',                 'Create new vendors'],
            ['vendor:update',                 'Update existing vendors'],
            ['vendor:delete',                 'Delete exisiting vendors'],

            ['vendor_type:index',         'List all vendor types'],
            ['vendor_type:show',          'View a vendor types'],
            ['vendor_type:create',        'Create new vendor category'],
            ['vendor_type:update',        'Update existing vendor category'],
            ['vendor_type:delete',        'Delete existing vendor category'],

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
