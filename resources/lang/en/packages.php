<?php

return [
    'title' => 'Packages',

    'attributes' => [
        'name'              => 'Name',
        'description'       => 'Description',
        'validity_type'     => 'Validity Type',
        'validity_quantity' => 'Validity Quantity',
        'meta'              => 'Meta',
        'fee'               => 'Fee',
        'color'             => 'Color',
        'status'            => 'Status',
        'created_at'        => 'Created At',
        'updated_at'        => 'Last Updated At',
        'validity'          => 'Validity',
        'tax_code'          => 'Tax Code'
    ],

    'validity' => [
        'days' => 'One day|:count days',
        'months' => 'One month|:count months',
        'years' => 'One year|:count years'
    ],

    'buttons' => [
        'create' => 'Create New Package',
        'edit' => 'Edit Package',
        'all' => 'All Packages',
    ],

    'notices' => [
        'created' => 'Package :name created',
        'updated' => 'Package :name updated',
        'deleted' => 'Package :name deleted',
        'activated' => 'Package :name activated',
        'deactivated' => 'Package :name deactivated'
    ],
    
    'views' => [
        'index' => [
            'title' => 'Packages',
            'keywords' => 'Keywords',
            'status' => 'Status',
        ],
        'show' => [
            'title' => 'View',
            'legend' => 'Package Details'
        ],
        'create' => [
            'title' => 'New',
        ],
        'edit' => [
            'title' => 'Edit',
            'legend' => 'Package Details'
        ],
        'revisions' => [

        ],
        'payment' => [
            'title' => 'Package Payment',
            'summary' => 'Payment Summary',
        ],
    ],
];