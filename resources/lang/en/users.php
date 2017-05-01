<?php

return [
    'title' => 'Users',

    'attributes' => [
        'name' => 'Name',
        'email' => 'Email',
        'status' => 'Status',
        'roles' => 'Roles',
        'organization' => 'Organization',
        'vendor' => 'Vendor',
        'password' => 'Password',
        'password_confirmation' => 'Confirm Password',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New User',
        'edit' => 'Edit User',
        'assume' => 'Login As This User',
        'all' => 'All Users',
    ],

    'notices' => [
        'created' => 'User :name created',
        'updated' => 'User :name updated',
        'deleted' => 'User :name archived',
        'assumed' => 'Logged in as :name',
        'activated' => 'User :name activated',
        'suspended' => 'User :name suspended',
        'restored' => 'User :name restored'
    ],

    'views' => [
        'index' => [
            'keywords' => 'Search Name or Email',
            'role' => 'By Role',
            'status' => 'By Status',
            'link' => 'Users'
        ],
        'archives' => [
            'title' => 'User Archives',
            'link' => 'Archives',
        ],
        'show' => [
            'title' => 'Show'
        ],
        'create' => [
            'title' => 'New User',
        ],
        'edit' => [
        ]
    ]
];