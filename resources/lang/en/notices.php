<?php

return [
    'title' => 'Notice',

    'attributes' => [
        'name' => 'Name',
        'number' => 'Number',
        'description' => 'Description',
        'rules' => 'Rules',
        'price' => 'Price',
        'published_at' => 'Published At',
        'expired_at' => 'Expired At',
        'purchased_at' => 'Purchased At',
        'submission_at' => 'Submission At',
        'submission_address' => 'Submission Address',
        'notice_type_id' => 'Type',
        'notice_category_id' => 'Category',
        'organization_id' => 'Organization',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New Notice',
        'edit' => 'Edit Notice',
        'all' => 'All Notices',
    ],

    'notices' => [
        'created' => 'Notice :name created.',
        'updated' => 'Notice :name updated.',
        'deleted' => 'Notice :name deleted.',
        'activated' => 'Notice :name activated.',
        'deactivated' => 'Notice :name deactivated.',
        'published' => 'Notice :name published.',
        'unpublished' => 'Notice :name unpublished.',
    ],
    
    'views' => [
        'index' => [
            'title' => 'Notices',
            'keywords' => 'Keywords',
            'status' => 'Status',
        ],
        'show' => [
            'title' => 'View',
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