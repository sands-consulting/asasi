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
            'end_at' => 'End Date',
            'weightage' => 'Weightage'
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
        ],

        'eligibles' => [
            'name' => 'Vendor',
            'exception' => 'Exception',
            'notified_at' => 'Notification Date & Time',
        ],

        'invitations' => [
            'name' => 'Vendor',
            'created_at' => 'Invitation Date & Time',
            'sent_at' => 'Sent Date & Time'
        ],

        'purchases' => [
            'name' => 'Vendor',
            'number' => 'Number',
            'created_at' => 'Purchase Date & Time'
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
        'add-qualification' => 'Add Qualification',

        'add-eligible' => 'Add Eligible Vendor',
        'add-invitation' => 'Add Invitation',
    ],

    'menu' => [
        'settings' => 'Settings',

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
        
        'evaluations' => 'Evaluations',
        'award' => 'Award',
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
        'eligible' => ':name successfully added to eligible vendors.',
        'invitation' => 'Vendor successfully invited.',
        'bookmarked' => 'Notice was successfully bookmarked.',
        'submissions' => 'Submissions was successfully saved.',
        'awarded' => 'Award was successfully saved.'
    ],

    'alerts' => [
        'validation' => 'Please verify all required fields are filled.',
        'eligible' => 'Unable to add vendor as eligible.',
        'invitation' => 'Unable to invite vendor.',
        'bookmark' => 'Unable to bookmark notice.'
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
                    'duration' => 'Unit for the duration of the notice submission',
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
                ],
                'eligibles' => [
                    'empty' => 'No eligible vendors.'
                ],
                'purchases' => [
                    'empty' => 'No notice purchase.'
                ],
                'submissions' => [
                    'evaluators' => 'Evaluators',
                    'empty' => 'No submission recorded.',
                    'select-evaluator' => 'Search user to assign as evaluator'
                ],
                'evaluations' => [
                    'empty' => 'No evaluator assigned.',
                ],
                'award' => [
                    'select-submission' => 'Please select submission',
                    'submission' => 'Submission',
                    'period' => 'Please enter project period',
                    'price' => 'Please enter the awarded price'
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
                ],
                'eligible' => [
                    'title' => 'Add Eligible Vendor',
                    'vendor_id' => 'Select Vendor',
                    'submit' => 'Submit'
                ],
                'invitation' => [
                    'title' => 'Invite Vendor',
                    'vendor_id' => 'Select Vendor',
                    'submit' => 'Invite'
                ]
            ]
        ],
    ],

    'emails' => [
        'eligible' => [
            'subject' => 'Notice Eligiblity',
            'greeting' => 'Hi, :name!',
            'line-1' => 'Your company, :vendor is eligible to participate the following notice:',
            'action' => 'View Notice'
        ],
        'invitation' => [
            'subject' => 'Notice Invitation',
            'greeting' => 'Hi, :name!',
            'line-1' => 'Your company, :vendor is invited to participate the following notice:',
            'action' => 'View Notice'
        ]
    ], 

    'notifications' => [
        'eligible' => 'You are eligible for :notice.',
        'invitation' => 'You are invited to participate in :notice.'
    ],
];