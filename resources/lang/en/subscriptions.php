<?php

return [
    'title' => 'Subscriptions',
    'attributes' => [
        'name' => 'Subscription Name',
        'started_at' => 'Started At',
        'expired_at' => 'Expired At',
        'package_id' => 'Package',
        'vendor_id' => 'Vendor',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'deleted_at' => 'Deleted At',
    ],

    'buttons' => [
        'all' => 'All Subscriptions',
        'approve' => 'Approve',
        'create' => 'Create New Subscription',
    ],

    'notices' => [
        'public' => [
            'subscribed' => 'You have been subscribed.',
        ],
        'created' => 'Subscription :name created',
        'updated' => 'Subscription :name updated',
        'deleted' => 'Subscription :name deleted',
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
            'title' => 'View',
            'admin' => [
                'title' => 'View Subscription'
            ],
        ],
        'create' => [
            'title' => 'Create New Subscription',
        ],
        'edit' => [
            'title' => 'Edit',
        ],
        'apply' => [
            'title' => 'Subscription Application Form',
        ],
        'current' => [
            'title' => 'Your Subscription'
        ],
        'history' => [ 
            'title' => 'Subscriptions history',
            'list'  => 'List of Subscription History'
        ]
	]
];
