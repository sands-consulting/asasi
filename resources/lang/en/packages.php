<?php

return [
    'title' => 'Packages',

    'attributes' => [
        'name' => 'Name',
        'validity_type' => 'Validity Type',
        'validity_quantity' => 'Validity Quantity',
        'meta' => 'Meta',
        'fee_amount' => 'Fee Amount',
        'fee_tax_code' => 'Fee Tax Code',
        'fee_tax_rate' => 'Fee Tax Rate',
        'label_color' => 'Label Color',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
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