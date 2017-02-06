<?php

return [
    'title' => 'Notice',

    'attributes' => [
        'name' => 'Name',
        'number' => 'Number',
        'description' => 'Description',
        'rules' => 'Rules',
        'price' => 'Price',
        'published_at' => 'Publication Date & Time',
        'expired_at' => 'Expiration Date & Time',
        'purchased_at' => 'Availability Date & Time',
        'submission_at' => 'Submission Date & Time',
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

    'navs' => [
        'details' => 'Details',
        'events' => 'Events',
        'qualifications' => 'Qualifications',
        'files' => 'Files',

        'eligibles' => 'Eligibles',
        'purchases' => 'Purchases',
        'submissions' => 'Submissions',
        'evaluations' => 'Evaluations',
        'award' => 'Award',

        'settings' => 'Settings',
        'evaluators' => 'Evaluators',
        'evaluation_criterias' => 'Evaluation Criterias'
    ],

    'notices' => [
        'created' => 'Notice :name created.',
        'updated' => 'Notice :name updated.',
        'deleted' => 'Notice :name deleted.',
        'activated' => 'Notice :name activated.',
        'deactivated' => 'Notice :name deactivated.',
        'published' => 'Notice :name published.',
        'unpublished' => 'Notice :name unpublished.',
        'cancelled' => 'Notice :name cancelled.',
        'submission_saved' => 'Your submission for Notice :number successfully saved.',
        'submission_submitted' => 'Your submission for Notice :number successfully submitted.',
    ],
    
    'views' => [
        'index' => [
            'notices' => [
                'title' => 'All Notices'
            ]
        ],
        'show' => [
            'back' => 'All Notices',
            'purchase' => 'Add to Cart'
        ],
        'admin' => [
            'index' => [
                'title' => 'Notices',
                'keywords' => 'Keywords',
                'status' => 'Status',
            ],
            'show' => [
                'title' => 'View Notice',
                'invitation' => 'By Invitation',
                'advertise' => 'Advertise Only',
            ],
            'create' => [
                'title' => 'New',
                'table' => [
                    'empty' => 'No record found. Please create new row by clicking on <i class="icon-add"></i> button on top right corner of this table.'
                ],
            ],
            'edit' => [
                'title' => 'Edit',
            ],
            'revisions' => [
            ],
            'events' => [
                'empty' => 'No event information.',
                'table' => [
                    'name' => 'Name',
                    'type' => 'Type',
                    'datetime' => 'Date & Time',
                    'location' => 'Location'
                ]
            ]
        ]
    ],
];