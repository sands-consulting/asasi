<?php

return [
    'title' => 'Projects',

    'attributes' => [
        'name' => 'Name',
        'number' => 'number',
        'descriptions' => 'Desicription',
        'type' => 'Type',
        'organization' => 'Organization',
        'vendor' => 'Vendor',
        'managers' => 'Managers',
        'status' => 'Status',
        'progress' => 'Progress',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At'
    ],

    'buttons' => [
        'create' => 'Create New Project',
        'all' => 'All Projects',
        'edit' => 'Edit Project'
    ],

    'notices' => [
        'created' => 'Project :name created',
        'updated' => 'Project :name updated',
        'deleted' => 'Project :name deleted'
    ],

    'views' => [
        'index' => [
            'keywords' => 'Search Name or Email',
            'category' => 'By Category',
            'status' => 'By Status'
        ],
        'show' => [
            'panels' => [
                'total' => 'Total',
                'usage' => 'Usage',
                'allocated' => 'Allocated',
                'balance' => 'Balance',
                'notices' => 'Notices',
            ]
        ],
        'create' => [
            'title' => 'New Project',
        ],
        'edit' => [
        ]
    ]
];