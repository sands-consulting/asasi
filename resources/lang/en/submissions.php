<?php

return [
    'title' => 'Submission',

    'attributes' => [
        'id' => 'Submission Id',
        'type' => 'Type',
        'avg_score' => 'Average Score',
        'notice_id' => 'Notice',
        'vendor_id' => 'Vendor',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
        'deleted_at' => 'Deleted At',
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
        'evaluate' => [
            'title' => 'Evaluate : :submission'
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