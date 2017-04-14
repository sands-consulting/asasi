<?php

return [
    'title' => 'Notices',

    'attributes' => [
        'name' => 'Name',
        'number' => 'Number',
        'description' => 'Description',
        'rules' => 'Rules',
        'price' => 'Price',
        'tax_id' => 'Tax',
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

        'evaluation-types' => [
            'type' => 'Type',
            'start_at' => 'Start Date',
            'end_at' => 'End Date'
        ],

        'events' => [
            'type' => 'Type',
            'name' => 'Name',
            'location' => 'Location',
            'required' => 'Required',
            'schedule_at' => 'Date & Time',
            'details' => 'Details'
        ]
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

        'add-event' => 'Add Event',
    ],

    'menu' => [
        'details' => 'Details',
        'events' => 'Events',
        'qualifications' => 'Qualifications',
        'files' => 'Files',

        'allocations' => 'Allocations',
        'evaluation-requirements' => 'Evaluation Requirements',
        'submission-requirements' => 'Submission Requirements',

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
            'notices' => [
                'title' => 'Notices',
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

            'create' => [
                'title' => 'New Notice',
            ],

            'edit' => [
                'title' => 'Edit Notice',
            ],

            'form' => [
                'settings' => [
                    'type' => 'Please select notice type',
                    'category' => 'Please select notice category',
                    'organization' => 'Please select organization for this notice',
                    'invitation' => 'Invite only selected vendors',
                    'purchase' => 'Allow notice purchase via system',
                    'submission' => 'Allow notice submission via system',
                    'evaluation' => 'Allow notice evaluation via system',
                    'evaluation-settings' => 'Notice Evaluation Settings',
                    'award' => 'Allow notice award via system',
                ]
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