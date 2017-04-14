<?php

return [
    'title' => 'Qualification Codes',

    'attributes' => [
        'code' => 'Code',
        'name' => 'Name',
        'type' => 'Type',
        'status' => 'Status',
        'created_at' => 'Created At',
    ],

    'buttons' => [
        'create' => 'Create New Code',
        'all' => 'All Codes',
        'edit' => 'Edit Code'
    ],

    'notices' => [
        'created' => 'Qualification Code :code - :name created',
        'updated' => 'Qualification Code :code - :name updated',
        'deleted' => 'Qualification :code - :name deleted'
    ],

    'join-rules' => [
        'and' => 'AND',
        'or' => 'OR'
    ],

    'inner-rules' => [
        'and' => 'ALL',
        'or' => 'EITHER ONE'
    ],

    'views' => [
        'index' => [
            'keywords' => 'Search Code or Name',
            'type' => 'By Type',
            'status' => 'By Status'
        ],
        'show' => [
        ],
        'create' => [
            'title' => 'New Qualification Code',
        ],
        'edit' => [
        ]
    ]
];