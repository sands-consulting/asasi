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
        'contact_fax' => 'Fax Number',
        'contact_email' => 'Contact Email',
        'contact_website' => 'Website',
        'contact_telephone' => 'Telephone Number',
        'contact_person_designation' => 'Designation',
        'contact_person_name' => 'Contact Person Name',
        'contact_person_telephone' => 'Contact Person Telephone',
        'contact_person_email' => 'Contact Person Email',
        'capital_currency' => 'Capital Currency',
        'capital_authorized' => 'Capital Authorized',
        'capital_paid_up' => 'Capital Paid Up',
        'remarks' => 'Remarks',
        'type_id' => 'Vendor Type',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'deleted_at' => 'Deleted At',
    ],

    'buttons' => [
        'all' => 'All Vendors',
        'approve' => 'Approve',
        'assume' => 'Login As This Vendor',
        'create' => 'Create New Vendor',
        'create-application' => 'Create New Vendor Application',
        'edit' => 'Edit',
        'edit-application' => 'Edit Application',
        'complete-application' => 'Send Application',
        'cancel-application' => 'Cancel Application',
        'reject' => 'Reject',
    ],

    'notices' => [
        'public' => [
            'saved' => 'Your application has been saved.',
            'completed' => 'Your application has been submitted.',
            'no-vendor' => 'You must apply for vendor first.'
        ],
        'approved' => 'Vendor :name has been approved',
        'created'  => 'Vendor :name created',
        'updated'  => 'Vendor :name updated',
        'deleted'  => 'Vendor :name deleted',
        'rejected' => 'Vendor :name has been rejected',
    ],

	'views' => [
		'index' => [
            'title' => 'Vendors',
            'status'   => 'Status',
            'keywords' => 'Keywords',
		],
        'show' => [
            'title' => 'View',
            'admin' => [
                'title' => 'View Vendor'
            ],
        ],
        'create' => [
            'title' => 'Create New Vendor',
        ],
        'edit' => [
            'title' => 'Edit',
        ],
        'apply' => [
            'title' => 'Vendor Application Form',
        ],
        'pending' => [ 
            'title' => 'Application Pending Approval',
        ]
	]
];
