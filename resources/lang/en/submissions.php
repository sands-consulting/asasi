<?php

return [
    'title' => 'Submission',

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
        'create' => 'Create New Submission',
        'edit' => 'Edit Submission',
        'all' => 'All Submissions',
        'my_notices' => 'My Submissions',
    ],

    'notices' => [
        'created' => 'Submission :name created.',
        'updated' => 'Submission :name updated.',
        'deleted' => 'Submission :name deleted.',
        'activated' => 'Submission :name activated.',
        'deactivated' => 'Submission :name deactivated.',
        'published' => 'Submission :name published.',
        'unpublished' => 'Submission :name unpublished.',
    ],
    'types' => [
        'commercial' => 'Commercial',
        'technical' => 'Technical'
    ],

    'views' => [
        'index' => [
            'title' => 'Submissions',
            'keywords' => 'Keywords',
            'status' => 'Status',
        ],
        'lists' => [
            'title' => 'Submissions : :notice',
            'type' => 'Type',
            'keywords' => 'Keywords'
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

        ],
        'my_notices' => [
            'title' => 'My Submissions'
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
    ],
];