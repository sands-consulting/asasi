<?php

return [
    'title' => 'Notice Type',

    'attributes' => [
        'name' => 'Name',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New Notice Type',
        'edit' => 'Edit Notice Type',
        'all' => 'All Notice Types',
    ],

    'notices' => [
        'created' => 'Notice Type :name created',
        'updated' => 'Notice Type :name updated',
        'deleted' => 'Notice Type :name deleted',
        'activated' => 'Notice Type :name activated',
        'deactivated' => 'Notice Type :name deactivated'
    ],
    
    'views' => [
        'index' => [
            'title' => 'Notice Types',
            'keywords' => 'Keywords',
            'status' => 'Status',
        ],
        'show' => [
            'title' => 'View',
            'details' => 'Notice Type Details'
        ],
        'create' => [
            'title' => 'New',
        ],
        'edit' => [
            'title' => 'Edit',
        ],
        'revisions' => [

        ]
    ],
];