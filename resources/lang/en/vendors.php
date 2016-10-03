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
        'mof_number' => 'MOF Registration Number',
        'mof_expiry_date' => 'MOF Expiry Date',
        'mof_qualification_code' => 'MOF Qualification Code',
        'cidb_number' => 'CIDB Registration Number',
        'cidb_expiry_date' => 'CIDB Expiry Date',
        'cidb_gred' => 'CIDB Gred',
        'cidb_qualification_code' => 'CIDB Qualification Code',
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
        'suspend' => 'Suspend',
        'activate' => 'Activate',
        'blacklist' => 'Blacklist',
        'unblacklist' => 'Unblacklist',
    ],

    'notices' => [
        'public' => [
            'approved' => 'Your application already been approved. You cannot cancel your application.',
            'canceled' => 'Your application has been cancelled.',
            'cancel-failed' => 'Your application has been changed. Please check current status of your application.',
            'completed' => 'Your application has been submitted.',
            'complete-application' => 'Your application has been submitted for approval.',
            'incomplete-application' => 'Your application is not complete. Please fill all input to submit your application.',
            'no-vendor' => 'You must apply for vendor first.',
            'rejected' => 'Your application has been rejected.',
            'saved' => 'Your application has been saved.',
        ],
        'approved' => 'Vendor :name has been approved',
        'created'  => 'Vendor :name created',
        'updated'  => 'Vendor :name updated',
        'deleted'  => 'Vendor :name deleted',
        'rejected' => 'Vendor :name has been rejected',
        'suspended' => 'Vendor :name has been suspended',
        'activated' => 'Vendor :name has been activated',
        'blacklisted' => 'Vendor :name has been blacklisted',
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
                'title' => 'View Vendor',
                'legend' => 'Vendor Details'
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
