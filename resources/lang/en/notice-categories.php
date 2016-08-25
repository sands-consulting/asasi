<?php

return [
    'title' => 'Notice Category',

    'attributes' => [
        'name' => 'Name',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New Notice Category',
        'edit' => 'Edit Notice Category',
        'all' => 'All Notice Categorys',
    ],

    'notices' => [
        'created' => 'Notice Category :name created',
        'updated' => 'Notice Category :name updated',
        'deleted' => 'Notice Category :name deleted',
        'activated' => 'Notice Category :name activated',
        'deactivated' => 'Notice Category :name deactivated'
    ],
    
    'views' => [
        'index' => [
            'title' => 'Notice Categories',
            'keywords' => 'Keywords',
            'status' => 'Status',
        ],
        'show' => [
            'title' => 'View',
            'details' => 'Notice Category Details'
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