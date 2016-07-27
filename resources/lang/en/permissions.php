<?php

return [
    'title' => 'Permissions',

    'attributes' => [
        'group' => 'Permission Group',
        'name' => 'Name',
        'permission' => 'Permission',
        'roles' => 'Roles',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'views' => [
        'index' => [
            'keywords' => 'Search Permissions',
            'group' => 'By Group'
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