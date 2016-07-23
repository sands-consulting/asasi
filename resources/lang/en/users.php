<?php

return [
    'title' => 'Users',

    'attributes' => [
        'name' => 'Name',
        'email' => 'Email',
        'status' => 'Status',
        'roles' => 'Roles',
        'password' => 'Password',
        'confirm_password' => 'Confirm Password',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New User',
        'edit' => 'Edit User',
        'assume' => 'Login As This User'
    ],

    'notices' => [
        'created' => 'User :name created',
        'updated' => 'User :name updated',
        'deleted' => 'User :name deleted',
        'assumed' => 'Logged in as :name',
        'activated' => 'User :name activated',
        'suspended' => 'User :name suspended'
    ],

    'views' => [
        'index' => [
        ],
        'show' => [
            'no_roles' => 'No roles assigned'
        ],
        'create' => [
        ],
        'edit' => [
        ]
    ]
];