<?php

return [
    'title' => 'Tax Codes',

    'attributes' => [
        'id'     => 'Id',
        'name'   => 'Tax Name',
        'code'   => 'Tax Code',
        'rate'   => 'Tax Rate',
        'status' => 'Status',
    ],

    'buttons' => [
        'create' => 'Create Tax Code',
    ],

    'menu' => [

    ],

    'notices' => [
        'approved'  => 'Tax Code :name has been approved',
        'created'   => 'Tax Code :name created',
        'updated'   => 'Tax Code :name updated',
        'deleted'   => 'Tax Code :name deleted',
        'activated' => 'Tax Code :name has been activated',
    ],

    'views' => [
        'index'  => [
            'title'      => 'Tax Codes',
            'status'     => 'Status',
            'keywords'   => 'Keywords',
            'breadcrumb' => 'Tax Codes',
        ],
        'create' => [
            'title'      => 'Create New Tax Code',
            'breadcrumb' => 'Create',
        ],
        'edit'   => [
            'title' => 'Edit Tax Code',
        ],
    ],

    'emails' => [],

    'notifications' => [],
];
