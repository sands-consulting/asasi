<?php

return [
    'title' => 'Qualification Types',

    'attributes' => [
        'name' => 'Name',
        'status' => 'Status',
        'created_at' => 'Created At',
        'parent' => 'Parent Type',
        'code' => 'Code',
        'type' => 'Type',
        'start_at' => 'Valid From',
        'end_at' => 'Valid Until',
    ],

    'buttons' => [
        'create' => 'Create New Type',
        'all' => 'All Types',
        'edit' => 'Edit Type'
    ],

    'notices' => [
        'created' => 'Qualification Code Type :name created',
        'updated' => 'Qualification Code Type :name updated',
        'deleted' => 'Qualification Type :name deleted'
    ],

    'placeholders' => [
        'parent' => 'Select parent code if applicable',
    ],

    'types' => [
        'list' => 'List',
        'boolean' => 'Boolean'
    ],

    'views' => [
        'index' => [
            'keywords' => 'Search Name',
            'status' => 'By Status'
        ],
        'show' => [
        ],
        'create' => [
            'title' => 'New Qualification Code Type',
        ],
        'edit' => [
        ]
    ]
];