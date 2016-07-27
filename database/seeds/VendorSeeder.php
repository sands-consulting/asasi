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
            ['vendor:index',             'List all vendors'],
            ['vendor:show',              'View vendor details'],
            ['vendor:create',            'Create new vendor'],
            ['vendor:update',            'Update existing vendor'],
            ['vendor:duplicate',         'Duplicate existing vendor'],
            ['vendor:activate',          'Activate existing vendor'],
            ['vendor:deactivate',        'Deactivate existing vendor'],
            ['vendor:delete',            'Delete existing vendor'],
            ['vendor:revisions',         'View vendor revisions'],
            ['vendor:logs',              'View vendor logs'],

            ['vendor-type:index',             'List all vendor types'],
            ['vendor-type:show',              'View vendor type details'],
            ['vendor-type:create',            'Create new vendor type'],
            ['vendor-type:update',            'Update existing vendor type'],
            ['vendor-type:duplicate',         'Duplicate existing vendor type'],
            ['vendor-type:activate',          'Activate existing vendor type'],
            ['vendor-type:deactivate',        'Deactivate existing vendor type'],
            ['vendor-type:delete',            'Delete existing vendor type'],
            ['vendor-type:revisions',         'View vendor type revisions'],
            ['vendor-type:logs',              'View vendor type logs']
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
