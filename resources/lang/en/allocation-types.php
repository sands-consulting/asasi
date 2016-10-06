<?php

return [
    'title' => 'Allocation Type',

    'attributes' => [
        'name' => 'Name',
        'status' => 'Status',
        'created_at' => 'Created At',
    ],

    'buttons' => [
        'create' => 'Create New Type',
        'all' => 'All Allocation Types',
    ],

    'notices' => [
        'created' => 'Type :name created',
        'updated' => 'Type :name updated',
        'deleted' => 'Type :name deleted'
    ],

    'views' => [
        'index' => [
            'keywords' => 'Search Name or Email',
            'category' => 'By Category',
            'status' => 'By Status'
        ],
        'show' => [
        ],
        'create' => [
            'title' => 'New Type',
        ],
        'edit' => [
        ]
    ]
];