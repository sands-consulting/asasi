<?php

use App\Permission;
use App\Role;
use App\User;
use App\Vendor;
use App\VendorType;
use App\Services\PermissionService;
use App\Services\RoleService;
use App\Services\UserService;
use App\Services\VendorService;
use App\Services\VendorTypeService;
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
        DB::table('user_vendor')->truncate();
        DB::table('vendor_types')->truncate();
        DB::table('vendors')->truncate();

        $vendor_types = [
            ['SSM',     'Sole Proprietorship'],
            ['SSM',     'Partnership'],
            ['SSM',     'Limited Liability Partnership'],
            ['SSM',     'Private Limited Company'],
            ['SSM',     'Company Limited by Guarantee'],
            ['SSM',     'Limited Company'],
            ['SSM',     'Public Limited Company'],
            ['SKM',     'Cooperative'],
            ['ROS',     'Association / Club / Society'],
            ['BAR',     'Law Firm'],
            ['BEM',     'Professional Engineer'],
            ['BQSM',    'Professional Quantity Surveryor'],
            ['LAM',     'Professional Architect'],
            ['MIA',     'Professional Accounting Firm']
        ];

        foreach($vendor_types as $type)
        {
            VendorTypeService::create(new VendorType, [
                'incorporation_authority' => $type[0],
                'incorporation_type' => $type[1]
            ]);
        }

        $vendor = VendorService::create(new Vendor, [
            'name' => 'Thera Future Inc.',
            'registration_number' => '123456-TF',
            'normalized_registration_number' => '123456TF',
            'tax_1_number' => '123456',
            'tax_2_number' => '789012',
            'contact_telephone' => '+60123456789',
            'contact_fax' => '+60323456788',
            'contact_email' => 'support@my-sands.com',
            'contact_website' => 'www.sands.consulting',
            'contact_person_name' => 'Amin Adha',
            'contact_person_designation' => 'Mr',
            'contact_person_telephone' => '+60123456788',
            'contact_person_email' => 'amin@my-sands.com',
            'capital_currency' => 'MYR',
            'capital_authorized' => '500000',
            'capital_paid_up' => '250000',
            'type_id' => 4,
            'status' => 'active',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'address' => [
                'line_one' => '11-2-2A, Jalan Pusat Bandar 2A',
                'line_two' => 'Seksyen 9',
                'postcode' => '43650',
                'city_id' => 18,
                'state_id' => 5,
                'country_id' => 1,
            ]
        ]);

        
        $user = UserService::create(new User(), [
            'name'      => 'Amin Adha',
            'email'     => 'amin@my-sands.com',
            'password'  => app()->make('hash')->make('amin1234'),
            'status'    => 'active',
        ]);

        $user->roles()->sync(Role::whereIn('name', ['vendor', 'vendor-admin'])->pluck('id')->toArray());
        $vendor->users()->attach($user, ['status' => 'active']);
    }
}
