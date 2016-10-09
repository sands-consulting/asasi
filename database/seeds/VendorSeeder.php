    <?php

use App\User;
use App\Vendor;
use App\VendorType;
use App\Permission;
use App\Role;
use App\Repositories\UsersRepository;
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
            ['vendor:approve',           'Approve vendor\'s applications'],
            ['vendor:reject',            'Reject vendor\'s applications'],
            ['vendor:activate',          'Activate suspended vendor'],
            ['vendor:suspend',           'Suspend existing vendor'],
            ['vendor:blacklist',         'Blacklist existing vendor'],
            ['vendor:unblacklist',       'Unblacklist existing vendor'],
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
            $perm = PermissionsRepository::create(new Permission(), [
                'name'          => $permissionData[0],
                'description'   => $permissionData[1],
            ]);
            $perm->roles()->attach(Role::first());
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

        $users = [
            [
                'id'        => 2,
                'name'      => 'Amin Adha',
                'email'     => 'amin@my-sands.com',
                'password'  => 'amin123',
                'verified'  => 1,
                'status'    => 'active',
            ],
        ];

        foreach ($users as $userData) {
            $userData['password'] = app()->make('hash')->make($userData['password']);
            UsersRepository::create(new User(), $userData);
        }

        Role::find(2)->permissions()->attach(3);

        VendorsRepository::create(new Vendor, [
            'name' => 'Sands Consulting Sdn Bhd',
            'registration_number' => 'M123123',
            'tax_1_number' => '1231234',
            'tax_2_number' => '1231235',
            'address_1' => '11-2-2A, Jalan Pusat Bandar 2A',
            'address_2' => 'Seksyen 9',
            'address_postcode' => '43650',
            'address_city_id' => 18,
            'address_state_id' => 5,
            'address_country_id' => 1,
            'contact_telephone' => '+60123456789',
            'contact_fax' => '+60323456788',
            'contact_email' => 'support@my-sands.com',
            'contact_website' => 'www.sands.consulting',
            'contact_person_name' => 'Amin Adha',
            'contact_person_designation' => 'Mr',
            'contact_person_telephone' => '+60123456788',
            'contact_person_email' => 'amin@my-sands.com',
            'capital_currency' => '1000000',
            'capital_authorized' => '500000',
            'capital_paid_up' => '250000',
            'type_id' => 4,
            'user_id' => 2,
            'status' => 'pending',
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'deleted_at' => null
        ]);
    }
}
