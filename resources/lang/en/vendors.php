<?php

return [
    'title' => 'Vendors',

    'attributes' => [
        'id' => 'Id',
        'name' => 'Vendor Name',
        'registration_number' => 'Registration No.',
        'tax_1_number' => 'Tax Number (1)',
        'tax_2_number' => 'Tax Number (2)',
        'address' => 'Address',
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
        'contact_person_title' => 'Title',
        'contact_person_name' => 'Contact Person Name',
        'contact_person_telephone' => 'Contact Person Telephone',
        'contact_person_email' => 'Contact Person Email',
        'capital_currency' => 'Capital Currency',
        'capital_authorized' => 'Authorized Capital',
        'capital_paid_up' => 'Paid Up Capital',
        'mof_number' => 'MOF Registration Number',
        'mof_expiry_date' => 'MOF Expiry Date',
        'mof_qualification_code' => 'MOF Qualification Code',
        'cidb_number' => 'CIDB Registration Number',
        'cidb_expiry_date' => 'CIDB Expiry Date',
        'cidb_gred' => 'CIDB Gred',
        'cidb_qualification_code' => 'CIDB Qualification Code',
        'remarks' => 'Remarks',
        'type_id' => 'Vendor Type',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'deleted_at' => 'Deleted At',

        'accounts' => [
            'account_name' => 'Account Name',
            'account_number' => 'Account Number',
            'bank_name' => 'Bank Name',
            'bank_iban' => 'Bank IBAN'
        ],

        'employees' => [
            'name' => 'Name',
            'designation' => 'Designation',
            'role' => 'Role',
            'nationality' => 'Nationality',

            'roles' => [
                'management' => 'Management',
                'executive' => 'Executive',
                'non-executive' => 'Non Executive'
            ]
        ],

        'files' => [
            'type' => 'Type',
            'file' => 'File',
            'size' => 'Size',
        ],

        'shareholders' => [
            'name' => 'Name',
            'identity_number' => 'Identity Number',
            'nationality' => 'Nationality',
            'percentage' => 'Percentage'
        ],
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

        'add-account' => 'Add Account',
        'add-employee' => 'Add Employee',
        'add-shareholder' => 'Add Shareholder',
        'add-file' => 'Add File',
    ],

    'menu' => [
        'details' => 'Details',
        'contact-person' => 'Contact Person',
        'qualifications' => 'Qualifications',
        'shareholders' => 'Shareholders',
        'employees' => 'Employees',
        'accounts' => 'Accounts',
        'files' => 'Files',

        'users' => 'Users',
        'subscriptions' => 'Subscriptions',
        'transactions' => 'Transactions',

        'invitations' => 'Invitations',
        'eligibles' => 'Eligibles',
        'purchases' => 'Purchases'
    ],

    'notices' => [
        'approved' => 'Your application already been approved. You cannot cancel your application.',
        'canceled' => 'Your application has been cancelled.',
        'cancel-failed' => 'Your application has been changed. Please check current status of your application.',
        'completed' => 'Your application has been submitted.',
        'complete-application' => 'Your application has been submitted for approval.',
        'incomplete-application' => 'Your application is not complete. Please fill all input to submit your application.',
        'no-vendor' => 'You must apply for vendor first.',
        'rejected' => 'Your application has been rejected.',
        'saved' => 'Your application has been saved.',
        'admin' => [
            'approved' => 'Vendor :name has been approved',
            'created'  => 'Vendor :name created',
            'updated'  => 'Vendor :name updated',
            'deleted'  => 'Vendor :name deleted',
            'rejected' => 'Vendor :name has been rejected',
            'suspended' => 'Vendor :name has been suspended',
            'activated' => 'Vendor :name has been activated',
            'blacklisted' => 'Vendor :name has been blacklisted',
        ]
    ],

	'views' => [
        'admin'=> [
            'index' => [
                'title' => 'Vendors',
                'status'   => 'Status',
                'keywords' => 'Keywords',
            ],
            'create' => [
                'title' => 'Create New Vendor',
            ],
            'edit' => [
                'title' => 'Edit',

                'application' => [
                    'title' => 'Company Application Form',
                    'description' => 'All fields are compulsary. The form can be save and update later for completion'
                ],

                'details' => [
                    'title' => 'Edit Company Details',
                    'description' => 'All fields are compulsary. The form can be save and update later for completion'
                ]
            ],
            'show' => [
                'details' => [
                    'address' => [
                        'title' => 'Address',
                        'empty' => 'No address information'
                    ],
                    'contact' => 'Contact Information',
                    'contact-person' => 'Contact Person',
                    'capital' => 'Capital Information',
                    'tax' => 'Tax Information'
                ],
                'accounts' => [
                    'empty' => 'No account recorded.'
                ],
                'employees' => [
                    'empty' => 'No employee recorded.'
                ],
                'shareholders' => [
                    'empty' => 'No shareholder recorded.'
                ],
                'files' => [
                    'empty' => 'No files uploaded.'
                ],
                'qualifications' => [
                    'empty' => 'No codes recorded.'
                ]
            ],
            'form' => [
                'submit' => 'Submit Application'
            ]
        ],
        'pending' => [
            'title' => 'Vendor Application Pending Approval',
            'content' => 'Application for <strong>:vendor-name</strong> is pending for approval by PROMPT adminstrator.<br><br>If have any enqiries, please contact us via contact form made available in PROMPT',
            'back' => 'Back to Home'
        ],
        'eligibles' => [
            'title' => 'Eligibles'
        ],
        'invitations' => [
            'title' => 'Invitations'
        ],
        'purchases' => [
            'title' => 'Purchases'
        ],
        'show' => [
            'back' => 'Dashboard'
        ]
	],

    'modals' => [
        'reject' => [
            'title' => 'Reject Vendor Application',
            'submit' => 'Notify Rejection'
        ]
    ],

    'emails' => [
        'submitted' => [
            'subject' => 'Vendor Application For Approval',
            'greeting' => 'Hi, :name!',
            'line-1' => 'Vendor :vendor is currently pending for review',
            'line-2' => 'Please login to review the vendor for approval / rejection.',
            'action' => 'View Vendor'
        ],
        'rejected' => [
            'subject' => 'Vendor Application Rejection',
            'greeting' => 'Hi, :name!',
            'line-1' => 'Your application for :vendor is rejected.',
            'line-2' => 'Remarks: :remarks',
            'line-3' => 'Please login to review your application.',
            'action' => 'View Application'
        ],
        'approved' => [
            'subject' => 'Vendor Application Approved',
            'greeting' => 'Hi, :name!',
            'line-1' => 'Your application for :vendor is succesful.',
            'line-2' => 'Please login and subscribe to access the system.',
            'action' => 'Subscribe'
        ]
    ], 

    'notifications' => [
        'submitted' => ':vendor needs your approval',
        'approved' => ':vendor application has been approved.'
    ],
];
