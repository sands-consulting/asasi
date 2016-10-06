<?php

return [
    'title' => 'Notice',

    'attributes' => [
        'title' => 'Title',
        'mandatory' => 'Mandatory',
        'require_file' => 'Require File',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New Technical Requirement',
        'edit' => 'Edit Technical Requirement',
        'all' => 'All Technical Requirements',
    ],

    'notices' => [
        'created' => 'Technical Requirement :title created.',
        'updated' => 'Technical Requirement :title updated.',
        'deleted' => 'Technical Requirement :title deleted.',
        'activated' => 'Technical Requirement :title activated.',
        'deactivated' => 'Technical Requirement :title deactivated.',
        'published' => 'Technical Requirement :title published.',
        'unpublished' => 'Technical Requirement :title unpublished.',
    ],
    
    'views' => [
        'index' => [
            'title' => 'Notices',
            'keywords' => 'Keywords',
            'status' => 'Status',
        ],
        'show' => [
            'title' => 'View',
        ],
        'create' => [
            'title' => 'New',
            'table' => [
                'empty' => 'No record found. Please create new row by clicking on <i class="icon-add"></i> button on bottom left corner of this table.'
            ],
        ],
        'edit' => [
            'title' => 'Edit',
        ],
        'revisions' => [

        ]
    ],
];