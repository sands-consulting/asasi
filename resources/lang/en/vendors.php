<?php

return [
    'title' => 'Vendors',
    'attributes' => [
        'name' => 'Vendor Name',
        'registration_number' => 'Registration Number',
        'tax_1_number' => 'Tax Number (1)',
        'tax_2_number' => 'Tax Number (2)',
        'address_1' => 'Line 1',
        'address_2' => 'Line 2',
        'address_postcode' => 'Postcode',
        'address_city_id' => 'City',
        'address_state_id' => 'State',
        'address_country_id' => 'Country',
        'contact_person_name' => 'Contact Person Name',
        'contact_telephone' => 'Telephone Number',
        'contact_fax' => 'Fax Number',
        'contact_email' => 'Contact Email',
        'contact_website' => 'Website',
        'capital_currency' => 'Capital Currency',
        'capital_authorized' => 'Capital Authorized',
        'capital_paid_up' => 'Capital Paid Up',
        'type_id' => 'Vendor Type',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'deleted_at' => 'Deleted At',
    ],

    'buttons' => [
        'all' => 'All Vendors',
        'assume' => 'Login As This Vendor',
        'create' => 'Create New Vendor',
        'create-application' => 'Create New Vendor Application',
        'edit' => 'Edit Vendor',
        'edit-application' => 'Edit Application',
        'complete-application' => 'Send Application',
        'cancel-application' => 'Cancel Application',
    ],

    'notices' => [
        'public' => [
            'saved' => 'Your application has been saved.',
            'completed' => 'Your application has been submitted.',
        ],
        'created' => 'Vendor :name created',
        'updated' => 'Vendor :name updated',
        'deleted' => 'Vendor :name deleted',
    ],

	'views' => [
		'index' => [
            'status'   => 'Status',
            'keywords' => 'Keywords',
		],
        'show' => [
        ],
        'create' => [
            'title' => 'Create New Vendor',
        ],
        'edit' => [
            'title' => 'Edit',
        ],
        'apply' => [
            'title' => 'Apply Vendor',
        ],
        'pending' => [ 
            'title' => 'Application Pending Approval',
        ]
	]
];
