<?php

return [
    'title' => 'Notices',

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

    'menu' => [
        'details' => 'Details',
        'events' => 'Events',
        'qualifications' => 'Qualifications',
        'files' => 'Files',

        'allocations' => 'Allocations',
        'evaluation-criterias' => 'Evaluation Criterias',
        'submission-criterias' => 'Submission Criterias',

        'invitations' => 'Invitatis',
        'eligibles' => 'Eligibles',
        'purchases' => 'Purchases',
        'submissions' => 'Submissions',
        
        'evaluators' => 'Evaluators',
        'evaluations' => 'Evaluations',
        'award' => 'Award',

        'settings' => 'Settings',
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

    'file_types' => [
        'internal' => 'Internal Use Only',
        'public' => 'For Public View',
        'purchase' => 'For Purchase Only',
    ],

    'settings' => [
        'invitation' => 'By Invitation',
        'advertise' => 'Advertise Only',
    ],
    
    'views' => [
        'index' => [
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

            'allocations' => [
                
            ],

            'allocations' => [
                'empty' => 'No allocation information.',
                'table' => [
                    'type' => 'Type',
                    'name' => 'Name',
                    'amount' => 'Amount'
                ]
            ],

            'evaluation-criterias' => [
                'empty' => 'No criteria defined.',
                'table' => [
                    'title' => 'Title',
                    'full-score' => 'Full Score'
                ]
            ],

            'events' => [
                'empty' => 'No event information.',
                'table' => [
                    'type' => 'Type',
                    'datetime' => 'Date & Time',
                    'details' => 'Details'
                ]
            ],

            'files' => [
                'empty' => 'No file uploaded.',
                'table' => [
                    'type' => 'Type',
                    'name' => 'Name',
                    'size' => 'File Size'
                ]
            ],

            'submission-criterias' => [
                'empty' => 'No criteria defined.',
            ],

            'qualifications' => [
                'empty' => 'No qualification information.',
                'rules' => [
                    'AND' => 'AND',
                    'OR' => 'OR'
                ]
            ]
        ]
    ],
];