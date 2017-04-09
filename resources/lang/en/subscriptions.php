<?php

return [
    'title' => 'Subscriptions',

    'attributes' => [
        'start_at' => 'Started At',
        'end_at' => 'Expired At',
        'package_id' => 'Package',
        'vendor_id' => 'Vendor',
        'remarks' => 'Remarks',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'deleted_at' => 'Deleted At',
        'number' => 'Number',
        'package' => 'Package',
    ],

    'buttons' => [
        'all' => 'All Subscriptions',
        'approve' => 'Approve',
        'create' => 'Create New Subscription',
        'edit' => 'Edit',
    ],

    'notices' => [
        'created' => 'Subscription :name created',
        'updated' => 'Subscription :name updated',
        'deleted' => 'Subscription :name deleted',
        'activated' => 'Subscription has been activated',
        'deactivated' => 'Subscription has been deactivated',
        'cancelled' => 'Subscription has been cancelled',        

        'no-subscription' => 'No active subscription',

        'x1' => 'Unable to process your subscription request',
        'x2' => 'Unable to process your payment',
    ],

	'views' => [
        'admin' => [
    		'index' => [
                'title'    => 'Subscriptions',
                'status'   => 'Status',
                'keywords' => 'Keywords',
                'package' => 'Package'
            ],
            'show' => [
                'subscriber' => [
                    'title' => 'Subscriber',
                    'name' => 'Name',
                    'address' => 'Address'
                ],
                'subscription' => [
                    'title' => 'Subscription Information',
                ],
                'package' => [
                    'title' => 'Package Information'
                ]
            ],
            'create' => [
                'title' => 'Create New Subscription',
                'package' => [
                    'name' => 'Name',
                    'fee' => 'Fee'
                ]
            ],
            'edit' => [
                'title' => 'Edit',
            ],
            'form' => [
                'subscriber' => 'Subscriber',
                'package' => 'Package',
                'select-subscriber' => 'Select Subscriber',
                'select-package' => 'Select Package'
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
	],

    'modals' => [
        'cancel' => [
            'title' => 'Subscription Cancellation',
            'submit' => 'Cancel This Subscription'
        ]
    ]
];
