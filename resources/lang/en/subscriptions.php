<?php

return [
    'title' => 'Subscriptions',
    'attributes' => [
        'name' => 'Subscription Name',
        'start_at' => 'Started At',
        'end_at' => 'Expired At',
        'package_id' => 'Package',
        'vendor_id' => 'Vendor',
        'remarks' => 'Remarks',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'deleted_at' => 'Deleted At',
    ],

    'buttons' => [
        'all' => 'All Subscriptions',
        'approve' => 'Approve',
        'create' => 'Create New Subscription',
        'edit' => 'Edit',
    ],

    'notices' => [
        'public' => [
            'subscribed' => 'You have been subscribed.',
        ],
        'created' => 'Subscription :name created',
        'updated' => 'Subscription :name updated',
        'deleted' => 'Subscription :name deleted',
        'activated' => 'Subscription has been activated',
        'deactivated' => 'Subscription has been deactivated',
        'cancelled' => 'Subscription has been cancelled',
        'existed' => 'Other active subscription for :name already exists.',
        'no-subscription' => 'No active subscription'
    ],

	'views' => [
        'admin' => [
    		'index' => [
                'title'    => 'Subscriptions',
                'status'   => 'Status',
                'keywords' => 'Keywords',
            ],
            'show' => [
                'title' => 'View Subscription',
                'admin' => [
                    'title' => 'View Subscription'
                ],
            ],
            'create' => [
                'title' => 'Select Package',
                'package' => [
                    'name' => 'Name',
                    'fee' => 'Fee'
                ]
            ],
            'edit' => [
                'title' => 'Edit',
            ]
        ],
        'create' => [
            'packages' => [
                'title' => 'Select Package'
            ],
            'confirmation' => [
                'title' => 'Subscription Confirmation',
                'fee' => 'Fee',
                'tax' => 'Tax',
                'amount' => 'Amount',
                'gateway' => 'Payment Gateway',
                'please-select' => 'Please select',
                'pay-now' => 'Proceed to Payment'
            ],
        ]
	]
];
