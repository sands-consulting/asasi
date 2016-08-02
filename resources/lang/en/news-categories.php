<?php

return [
    'title' => 'News Category',

    'attributes' => [
        'name'  => 'Name',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New Category',
        'all' => 'All Categories',
    ],

    'notices' => [
        'created' => 'Category :name created',
        'updated' => 'Category :name updated',
        'deleted' => 'Category :name deleted',
    ],

    'views' => [
        'index' => [
        ],
        'show' => [
        ],
        'create' => [
            'title' => 'New Categories',
        ],
        'edit' => [
        ]
    ]
];