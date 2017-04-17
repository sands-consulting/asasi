<?php

return [
    'title' => 'Settings',

    'attributes' => [
        'key' => 'Key',
        'value' => 'Value',
    ],

    'system' => [
        'app_name' => 'System Name',
        'currency' => 'System Currency',
        'date_format' => 'Date Format',
        'datetime_format' => 'Date Time Format',
        'vendor_role_id' => 'Default Vendor Role'
    ],

    'license' => [
        'name' => 'Licensee',
        'url' => 'Authorized URL',
        'validity' => 'Validity',
        'modules' => 'Modules',
    ],

    'modules' => [
        'vendor' => 'Vendor Management',
        'notice' => 'Notice Management',
        'purchase' => 'Online Purchase',
        'submission' => 'Online Submission',
        'evaluation' => 'Submission Evaluation',
        'award' => 'Project Award',
        'project' => 'Project Management',
    ],

    'notices' => [
        'updated' => 'Settings successfully updated.'
    ],

    'views' => [
        'edit' => [
            'system' => [
                'title' => 'System Settings'
            ],
            'license' => [
                'title' => 'License Information',
                'upload' => 'Upload New License',
                'disabled' => 'License Renewal Disabled.'
            ]
        ]
    ]
];