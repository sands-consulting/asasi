<?php

return [
    'title' => 'Project Milestones',

    'attributes' => [
        'name' => 'Name',
        'number' => 'number',
        'description' => 'Description',
        'cost' => 'Cost',
        'organization' => 'Organization',
        'vendor' => 'Vendor',
        'contact_name' => 'Contact Name',
        'contact_position' => 'Contact Position',
        'contact_phone' => 'Contact Phone',
        'contact_fax' => 'Contact Fax',
        'contact_email' => 'Contact Email',
        'managers' => 'Managers',
        'organization' => 'Organization',
        'notice' => 'Notice',
        'status' => 'Status',
        'progress' => 'Progress',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At'
    ],

    'buttons' => [
        'create' => 'Create New Project',
        'all' => 'All Projects',
        'edit' => 'Edit Project'
    ],

    'notices' => [
        'created' => 'Project :number created',
        'updated' => 'Project :number updated',
        'deleted' => 'Project :number deleted'
    ],

    'views' => [
        'index' => [
            'keywords' => 'Search Name or Email',
            'category' => 'By Category',
            'status' => 'By Status'
        ],
        'show' => [
            'panels' => [
                'total' => 'Total',
                'usage' => 'Usage',
                'allocated' => 'Allocated',
                'balance' => 'Balance',
                'notices' => 'Notices',
            ]
        ],
        'create' => [
            'title' => 'New Project',
        ],
        'edit' => [
        ]
    ]
];