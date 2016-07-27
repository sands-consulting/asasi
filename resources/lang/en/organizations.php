<?php

return [
    'title' => 'Organizations',

    'attributes' => [
        'name' => 'Name',
        'short_name' => 'Short Name',
        'parent' => 'Parent Organization',
        'roles' => 'Roles',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New Organization',
        'edit' => 'Edit Organization',
        'assume' => 'Login As This Organization',
        'all' => 'All Organizations',
    ],

    'notices' => [
        'created' => 'Organization :name created',
        'updated' => 'Organization :name updated',
        'deleted' => 'Organization :name deleted',
        'activated' => 'Organization :name activated',
        'deactivated' => 'Organization :name deactivated',
        'suspended' => 'Organization :name suspended'
    ],

    'views' => [
        'index' => [
            'keywords' => 'Search Organization',
            'status' => 'By Status'
        ],
        'show' => [
        ],
        'create' => [
            'title' => 'New Organization',
        ],
        'edit' => [
        ],
        'form' => [
            'select_parent' => 'Select parent Organization if applicable'
        ]
    ]
];