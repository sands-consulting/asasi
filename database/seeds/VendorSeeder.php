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
        DB::table('vendor_types')->truncate();
        DB::table('vendors')->truncate();

        $permissions = [
            ['vendor:index',        'List all vendors'],
            ['vendor:show',         'View a vendors'],
            ['vendor:create',       'Create new vendors'],
            ['vendor:update',       'Update existing vendors'],
            ['vendor:delete',       'Delete exisiting vendors'],

            ['vendor_type:index',   'List all vendor types'],
            ['vendor_type:show',    'View a vendor types'],
            ['vendor_type:create',  'Create new vendor category'],
            ['vendor_type:update',  'Update existing vendor category'],
            ['vendor_type:delete',  'Delete existing vendor category'],

        ];

        foreach ($permissions as $permissionData) {
            PermissionsRepository::create(new Permission(), [
                'name'          => $permissionData[0],
                'description'   => $permissionData[1],
            ]);
        }

        $vendor_types = [
            ['SSM', 'Sole Proprietorship'],
            ['SSM', 'Partnership'],
            ['SSM', 'Limited Liability Partnership'],
            ['SSM', 'Private Limited Company'],
            ['SSM', 'Company Limited by Guarantee'],
            ['SSM', 'Limited Company'],
            ['SSM', 'Public Limited Company'],

            ['SKM', 'Cooperative'],

            ['ROS', 'Association / Club / Society'],

            ['BAR',     'Law Firm'],
            ['BEM',     'Professional Engineer'],
            ['BQSM',    'Professional Quantity Surveryor'],
            ['LAM',     'Professional Architect'],
            ['MIA',     'Professional Accounting Firm']
        ];

        foreach($vendor_types as $type)
        {
            VendorTypesRepository::create(new VendorType, [
                'incorporation_authority' => $type[0],
                'incorporation_type' => $type[1]
            ]);
        }

        // VendorsRepository::create();
    }
}
