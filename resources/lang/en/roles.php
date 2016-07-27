<?php

return [
    'title' => 'Roles',

    'attributes' => [
        'name' => 'Name',
        'display_name' => 'Display Name',
        'description' => 'Description',
        'permissions' => 'Permissions',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New Role',
        'edit' => 'Edit Role',
        'all' => 'All Roles',
    ],

    'notices' => [
        'created' => 'Role :name created',
        'updated' => 'Role :name updated',
        'deleted' => 'Role :name deleted',
        'assumed' => 'Logged in as :name',
        'activated' => 'Role :name activated',
        'suspended' => 'Role :name suspended'
    ],

    'views' => [
        'index' => [
            'keywords' => 'Search Name or Email',
            'role' => 'By Role',
            'status' => 'By Status'
        ],
        'show' => [
        ],
        'create' => [
            'title' => 'New Role',
        ],
        'edit' => [
        ]
    ]
];