<?php

return [
    'title' => 'Bookmarks',

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
        'remarks' => 'Remarks',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New Notice',
        'edit' => 'Edit Notice',
        'all' => 'All Notices',
        'my_notices' => 'My Notices',
        'cancel' => 'Cancel',
        'submission' => 'Submission',
        'invoice' => 'Invoice',
        'receipt' => 'Receipt',
    ],

    'notices' => [
        'added' => 'Bookmark successfully saved',
        'removed' => 'Bookmark successfully removed',
    ],
    
    'views' => [
        'index' => [
            'title' => 'Notices',
            'keywords' => 'Keywords',
            'status' => 'Status',
        ],
        'show' => [
            'title' => 'View Notice',
        ],
        'create' => [
            'title' => 'New',
        ],
        'edit' => [
            'title' => 'Edit',
        ],
        'revisions' => [

        ],
        'my_notices' => [
            'title' => 'My Notices'
        ],
        'submission' => [
            'title' => 'Submission'
        ],
        'commercial' => [
            'title' => 'Commercial Requirements'
        ],
        'technical' => [
            'title' => 'Technical Requirements'
        ],
        'settings' => [
            'title' => 'Settings'
        ]
    ],
];