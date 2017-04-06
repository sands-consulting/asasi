<?php

return [
    'title' => 'Vendors',

    'attributes' => [
        'id'     => 'Id',
        'name'   => 'Tax Name',
        'code'   => 'Tax Code',
        'rate'   => 'Tax Rate',
        'status' => 'Status',
    ],

    'buttons' => [
        'create' => 'Create Tax Code',
    ],

    'menu' => [

    ],

    'notices' => [
        'approved'  => 'Vendor :name has been approved',
        'created'   => 'Vendor :name created',
        'updated'   => 'Vendor :name updated',
        'deleted'   => 'Vendor :name deleted',
        'activated' => 'Vendor :name has been activated',
    ],

    'views' => [
        'admin'       => [
            'index'  => [
                'title'    => 'Tax Codes',
                'status'   => 'Status',
                'keywords' => 'Keywords',
            ],
            'create' => [
                'title' => 'Create New Vendor',
            ],
            'edit'   => [
                'title' => 'Edit Vendor',

                'application' => [
                    'title'       => 'Company Application Form',
                    'description' => 'All fields are compulsary. The form can be save and update later for completion',
                ],

                'details' => [
                    'title'       => 'Edit Company Details',
                    'description' => 'All fields are compulsary. The form can be save and update later for completion',
                ],
            ],
            'show'   => [
                'accounts'  => [
                    'empty' => 'No account recorded.',
                ],
                'employees' => [
                    'empty' => 'No employee recorded.',
                ],
            ],
        ],
        'pending'     => [
            'title'   => 'Vendor Application Pending Approval',
            'content' => 'Application for <strong>:vendor-name</strong> is pending for approval by PROMPT adminstrator.<br><br>If have any enqiries, please contact us via contact form made available in PROMPT',
            'back'    => 'Back to Home',
        ],
        'eligibles'   => [
            'title' => 'Eligibles',
        ],
        'invitations' => [
            'title' => 'Invitations',
        ],
        'purchases'   => [
            'title' => 'Purchases',
        ],
        'show'        => [
            'back' => 'Dashboard',
        ],
        '_form'       => [
            'submit' => 'Submit',
        ],
    ],

    'emails' => [
    ],

    'notifications' => [
        'applied'  => [
            'content' => ':vendor_name needs your approval.',
        ],
        'approved' => [
            'content' => ':vendor_name vendor application has been approved.',
        ],
        'rejected' => [
            'content' => ':vendor_name vendor application has been rejected.',
        ],
    ],
];
