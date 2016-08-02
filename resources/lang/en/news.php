<?php

return [
    'title' => 'News',

    'attributes' => [
        'title' => 'Title',
        'content' => 'Content',
        'category' => 'Category',
        'organization' => 'Organization',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New News',
        'all' => 'All News',
    ],

    'notices' => [
        'created' => 'News :title created',
        'updated' => 'News :title updated',
        'deleted' => 'News :title deleted',
        'published' => 'News :title published',
        'unpublished' => 'News :title unpublished'
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
            'title' => 'New News',
        ],
        'edit' => [
        ]
    ]
];