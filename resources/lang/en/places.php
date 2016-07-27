<?php

return [
    'title' => 'Places',

    'attributes' => [
        'name' => 'Name',
        'code_2' => '2 Letter Code',
        'code_3' => '3 Letter Code',
        'type' => 'Type',
        'parent' => 'Parent Place',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New Place',
        'edit' => 'Edit Place',
        'all' => 'All Places',
        'activate' => 'Activate Place',
        'deactivate' => 'Deactivate Place',
    ],

    'notices' => [
        'created' => 'Place :name created',
        'updated' => 'Place :name updated',
        'deleted' => 'Place :name deleted',
        'assumed' => 'Logged in as :name',
        'activated' => 'Place :name activated',
        'deactivated' => 'Place :name deactivated'
    ],

    'types' => [
        'country' => 'Country',
        'state' => 'State',
        'city' => 'City'
    ],

    'views' => [
        'index' => [
            'keywords' => 'Search Name',
            'type' => 'By Type',
            'status' => 'By Status'
        ],
        'show' => [
        ],
        'create' => [
            'title' => 'New Place',
        ],
        'edit' => [
        ],
        'form' => [
            'select_parent' => 'Select Parent Place'
        ]
    ]
];