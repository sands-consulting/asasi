<?php

return [
    'title' => 'Notices',

    'attributes' => [
        'name' => 'Name',
        'number' => 'Number',
        'description' => 'Description',
        'rules' => 'Rules',
        'price' => 'Price',
        'tax_code_id' => 'Tax',
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
        ],

        'files' => [
            'name' => 'Name',
            'file' => 'File',
            'type' => 'Type',
            'size' => 'Size',
        ],

        'allocations' => [
            'allocation' => 'Allocation',
            'amount' => 'Amount',
            'name' => 'Name',
        ],

        'submission-requirements' => [
            'title' => 'Requirement',
            'field' => 'Field',
            'required' => 'Required'
        ],

        'evaluation-requirements' => [
            'title' => 'Requirement',
            'full_score' => 'Full Score',
            'required' => 'Required'
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
        'add-file' => 'Add File',
        'add-allocation' => 'Add Allocation',
        'add-requirement' => 'Add Requirement',
        'add-qualification' => 'Add Qualification'
    ],

    'menu' => [
        'details' => 'Details',
        'events' => 'Events',
        'qualifications' => 'Qualifications',
        'files' => 'Files',

        'allocations' => 'Allocations',
        'evaluation-requirements' => 'Evaluation Requirements',
        'submission-requirements' => 'Submission Requirements',

        'invitations' => 'Invitations',
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
        'validation' => 'Please verify all required fields are filled.',
        'submission_saved' => 'Your submission for Notice :number successfully saved.',
        'submission_submitted' => 'Your submission for Notice :number successfully submitted.',
    ],

    'file-types' => [
        'internal' => 'Internal Use Only',
        'public' => 'For Public View',
        'purchase' => 'For Purchase Only',
    ],

    'field-types' => [
        'checkbox' => 'Checkbox',
        'file' => 'File'
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
                ],
                'allocations' => [
                    'select' => 'Please select allocation'
                ]
            ],

            'show' => [
                'invitation' => 'Only By Invitation',
                'allocations' => [
                    'empty' => 'No allocation recorded.'
                ],
                'evaluation-requirements' => [
                    'empty' => 'No requirement defined.'
                ],
                'submission-requirements' => [
                    'empty' => 'No requirement defined.'
                ],
                'events' => [
                    'empty' => 'No event recorded.'
                ],
                'files' => [
                    'empty' => 'No file uploaded.'
                ],
                'qualifications' => [
                    'empty' => 'No qualification defined.',
                    'rules' => [
                        'and' => 'AND',
                        'or' => 'OR'
                    ]
                ]
            ],

            'modals' => [
                'cancel' => [
                    'title' => 'Notice Cancellation',
                    'submit' => 'Cancel This Notice',
                ],
                'delete' => [
                    'title' => 'Notice Deletion',
                    'submit' => 'Delete This Notice',
                ]
            ]
        ],
    ],
];