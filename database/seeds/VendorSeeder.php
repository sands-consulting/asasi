<?php

use App\FileType;
use App\Role;
use App\QualificationType;
use App\User;
use App\Vendor;
use App\VendorType;
use App\Services\FileTypeService;
use App\Services\QualificationTypeService;
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
        DB::table('vendor_accounts')->truncate();
        DB::table('vendor_employees')->truncate();
        DB::table('vendor_files')->truncate();
        DB::table('vendor_qualification_codes')->truncate();
        DB::table('vendor_qualifications')->truncate();
        DB::table('vendor_shareholders')->truncate();
        DB::table('vendors')->truncate();
        DB::table('vendor_types')->truncate();
        DB::table('file_types')->truncate();
        DB::table('qualification_types')->truncate();

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

        $files = [
            [
                'name' => 'ssm-form-9',
                'display_name' => 'SSM Form 9',
                'description' => 'SSM Form 9',
            ],
            [
                'name' => 'ssm-form-d',
                'display_name' => 'SSM Form D',
                'description' => 'SSM Form D',
            ],
            [
                'name' => 'mof-cert',
                'display_name' => 'MOF Certificate',
                'description' => 'MOF Certificate',
            ],
            [
                'name' => 'mof-bumi-cert',
                'display_name' => 'MOF Bumiputera Certificate',
                'description' => 'MOF Bumiputera Certificate',
            ],
            [
                'name' => 'cidb-cert',
                'display_name' => 'CIDB Certificate',
                'description' => 'CIDB Certificate',
            ],
            [
                'name' => 'cidb-bumi-cert',
                'display_name' => 'CIDB Bumiputera Certificate',
                'description' => 'CIDB Bumiputera Certificate',
            ],
            [
                'name' => 'local-license',
                'display_name' => 'Local Authority License / Certificate',
                'description' => 'Local Authority License / Certificate',
            ],
            [
                'name' => 'professional-license',
                'display_name' => 'Professional Body License / Certificate',
                'description' => 'Professional Body License / Certificate',
            ],
        ];

        foreach($files as $file)
        {
            FileTypeService::create(new FileType, $file);
        }

        $code_types = [
            [
                'name' => 'Ministry of Finance',
                'code' => 'MOF',
                'reference_one' => 'Certificate No.',
                'type' => 'list',
                'validity' => true,
                'codes' => [
                    ['code' => '010101', 'name' => 'Penerbitan Dan Penyiaran \ Penerbitan \ Bahan Bacaan Terbitan Luar Negara'],
                    ['code' => '010102', 'name' => 'Penerbitan Dan Penyiaran \ Penerbitan \ Bahan Bacaan'],
                    ['code' => '010103', 'name' => 'Penerbitan Dan Penyiaran \ Penerbitan \ Penerbitan Elektronik Atas Talian'],
                    ['code' => '010104', 'name' => 'Penerbitan Dan Penyiaran \ Penerbitan \ Bahan Penerbitan Elektronik Dan Muzik / Lagu'],
                ]
            ],
            [
                'name' => 'Ministry of Finance - Bumiputera',
                'code' => 'MOF-BUMI',
                'reference_one' => 'Certificate No.',
                'type' => 'boolean'
            ],
            [
                'name' => 'Construction Industry Development Board',
                'code' => 'CIDB-G',
                'reference_one' => 'Certificate No.',
                'type' => 'list',
                'validity' => true,
                'codes' => [
                    ['code' => 'G1', 'name' => 'Tidak melebihi RM200,000.00'],
                    ['code' => 'G2', 'name' => 'Tidak melebihi RM500,000.00'],
                    ['code' => 'G3', 'name' => 'Tidak melebihi RM1,000,000.00'],
                    ['code' => 'G4', 'name' => 'Tidak melebihi RM3,000,000.00'],
                    ['code' => 'G5', 'name' => 'Tidak melebihi RM5,000,000.00'],
                    ['code' => 'G6', 'name' => 'Tidak melebihi RM10,000,000.00'],
                    ['code' => 'G7', 'name' => 'Tiada had'],
                ],
                'children' => [
                    [
                        'name' => 'CIDB - Building',
                        'code' => 'CIDB-B',
                        'type' => 'list',
                        'codes' => [
                            ['code' => 'B01', 'name' => 'IBS: Prefabricated concrete system'],
                            ['code' => 'B02', 'name' => 'IBS: Steel frame system'],
                            ['code' => 'B03', 'name' => 'Restoration and conversation'],
                            ['code' => 'B04', 'name' => 'Construction works on buildings'],
                        ]
                    ],
                    [
                        'name' => 'CIDB - Civil Engineering',
                        'code' => 'CIDB-CE',
                        'type' => 'list',
                        'codes' => [
                            ['code' => 'CE01', 'name' => 'Road and pavement construction'],
                            ['code' => 'CE02', 'name' => 'Bridge and jetty construction'],
                        ]
                    ],
                    [
                        'name' => 'CIDB - Mechanical & Electrical',
                        'code' => 'CIDB-ME',
                        'type' => 'list',
                        'codes' => [
                            ['code' => 'M01', 'name' => 'Air conditioning and circulation systems'],
                            ['code' => 'M02', 'name' => 'Fire prevention and protection systems'],
                            ['code' => 'E01', 'name' => 'Sound systems'],
                            ['code' => 'E02', 'name' => 'Surveillance and security systems'],
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Construction Industry Development Board - Bumiputera',
                'code' => 'CIDB-BUMI',
                'reference_one' => 'Certificate No.',
                'type' => 'boolean'
            ],
        ];

        foreach($code_types as $type)
        {
            if(isset($type['children']))
            {
                $children = $type['children'];
                unset($type['children']);
            }

            if(isset($type['codes']))
            {
                $codes = $type['codes'];
                unset($type['codes']);
            }

            $parent = QualificationTypeService::create(new QualificationType, $type);

            if(isset($codes))
            {
                foreach($codes as $code)
                {
                    $parent->codes()->create($code);
                }
                unset($codes);
            }

            if(isset($children))
            {
                foreach($children as $child)
                {
                    if(isset($child['codes']))
                    {
                        $codes = $child['codes'];
                        unset($child['codes']);
                    }

                    $child['parent_id'] = $parent->id;
                    $in = QualificationTypeService::create(new QualificationType, $child);

                    if(isset($codes))
                    {
                        foreach($codes as $code)
                        {
                            $in->codes()->create($code);
                        }
                    }
                }
                unset($children);
            }
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
            'contact_person_title' => 'mr',
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
