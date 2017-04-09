<?php

return [
    'title' => 'Payment Gateways',

    'attributes' => [
        'name'      => 'Name',
        'label'     => 'Label',
        'type'      => 'Type',
        'prefix'    => 'Prefix',
        'default'   => 'Default',
        'status'    => 'Status',
        'organizations' => 'Organizations',
        'settings' => 'Settings',
    ],

    'types' => [
        'billplz' => 'BillPlz',
    ],

    'buttons' => [
        'create' => 'Create New Gateway',
        'edit' => 'Edit Gateway',
        'all' => 'All Gateways',
        'add-setting' => 'Add Setting'
    ],

    'notices' => [
        'created' => 'Gateway :name created',
        'updated' => 'Gateway :name updated',
        'deleted' => 'Gateway :name deleted'
    ],
    
    'views' => [
        'index' => [
            'title' => 'Payment Gateways',
            'keywords' => 'Keywords',
            'status' => 'Status',
        ],
        'create' => [
            'title' => 'New',
        ],
        'edit' => [
        ],
        'revisions' => [

        ]
    ],
];