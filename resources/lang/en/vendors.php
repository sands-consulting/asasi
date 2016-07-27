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
        'contact_name' => 'Contact Name',
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
        'create' => 'Create New Vendor',
        'edit' => 'Edit Vendor',
        'assume' => 'Login As This Vendor',
        'all' => 'All Vendors',
    ],

    'notices' => [
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
        'pending' => [
            'title' => 'Application Pending Approval',
        ]
	]
];
