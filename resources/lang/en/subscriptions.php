<?php

return [
    'title' => 'Subscriptions',
    'attributes' => [
        'name' => 'Subscription Name',
        'started_at' => 'Started At',
        'expired_at' => 'Expired At',
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
		'index' => [
            'title'    => 'Subscriptions',
            'status'   => 'Status',
            'keywords' => 'Keywords',
            
            'public' => [
                'title' => 'Subscription Packages',
                'details' => 'Subscription Details',
            ]
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
        ],
        'apply' => [
            'title' => 'Subscription Application Form',
        ],
        'current' => [
            'title' => 'Your Subscription',
            'no-subscription' => 'You have not subscribed to any package yet.'
        ],
        'history' => [ 
            'title' => 'Subscriptions history',
            'list'  => 'List of Subscription History'
        ]
	]
];
