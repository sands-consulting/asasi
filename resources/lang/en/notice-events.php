<?php

return [
    'title' => 'Notice Type',

    'attributes' => [
        'id' => 'Id',
        'name' => 'Name',
        'event_at' => 'Event At',
        'location' => 'Location',
        'notice_id' => 'Notice',
        'required' => 'Required',
        'notice_event_type_id' => 'Event Type',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New Notice Type',
        'edit' => 'Edit Notice Type',
        'all' => 'All Notice Types',
    ],

    'notices' => [
        'created' => 'Notice Type :name created',
        'updated' => 'Notice Type :name updated',
        'deleted' => 'Notice Type :name deleted',
        'activated' => 'Notice Type :name activated',
        'deactivated' => 'Notice Type :name deactivated'
    ],
    
    'views' => [
        'index' => [
            'title' => 'Notice Types',
            'keywords' => 'Keywords',
            'status' => 'Status',
        ],
        'show' => [
            'title' => 'View',
            'details' => 'Notice Type Details'
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

        ]
    ],
];