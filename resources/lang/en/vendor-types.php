<?php

return [
    'title' => 'Vendor Types',

    'attributes' => [
        'incorporation_authority' => 'Incorporation Authority',
        'incorporation_type'      => 'Incorporation Type',
        'status'                  => 'Status',
        'created_at'              => 'Created At',
        'updated_at'              => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New Vendor Type',
        'all'    => 'All Vendor Types',
    ],

    'notices' => [
        'created' => 'Vendor Type :name created',
        'updated' => 'Vendor Type :name updated',
        'deleted' => 'Vendor Type :name deleted',
    ],

    'views' => [
        'index'  => [
        ],
        'show'   => [
        ],
        'create' => [
            'title' => 'New Vendor Types',
        ],
        'edit'   => [
        ],
    ],
];