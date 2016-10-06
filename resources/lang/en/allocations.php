<?php

return [
    'title' => 'Allocations',

    'attributes' => [
        'name' => 'Name',
        'value' => 'Value',
        'type' => 'Type',
        'organization' => 'Organization',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At'
    ],

    'buttons' => [
        'create' => 'Create New Allocation',
        'all' => 'All Allocations',
        'edit' => 'Edit Allocation'
    ],

    'notices' => [
        'created' => 'Allocation :name created',
        'updated' => 'Allocation :name updated',
        'deleted' => 'Allocation :name deleted'
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
            'title' => 'New Allocation',
        ],
        'edit' => [
        ]
    ]
];