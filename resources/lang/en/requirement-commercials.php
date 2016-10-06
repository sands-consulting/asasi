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
        'create' => 'Create New Commercial Requirement',
        'edit' => 'Edit Commercial Requirement',
        'all' => 'All Commercial Requirements',
    ],

    'notices' => [
        'created' => 'Commercial Requirement :title created.',
        'updated' => 'Commercial Requirement :title updated.',
        'deleted' => 'Commercial Requirement :title deleted.',
        'activated' => 'Commercial Requirement :title activated.',
        'deactivated' => 'Commercial Requirement :title deactivated.',
        'published' => 'Commercial Requirement :title published.',
        'unpublished' => 'Commercial Requirement :title unpublished.',
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