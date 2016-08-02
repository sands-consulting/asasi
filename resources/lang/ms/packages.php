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
        'status' => 'Status',
        'created_at' => 'Dicipta Pada',
        'updated_at' => 'Tarikh Akhir Kemaskini',
    ],

    'buttons' => [
        'create' => 'Cipta Package Baharu',
        'edit' => 'Kemaskini Package',
        'all' => 'Senarai Packages',
    ],

    'notices' => [
        'created' => 'Package :name dicipta',
        'updated' => 'Package :name dikemaskini',
        'deleted' => 'Package :name dipadam',
    ],
    
    'views' => [
        'index' => [
        ],
        'show' => [
        ],
        'create' => [
            'title' => 'Package Baharu',
        ],
        'edit' => [
            'title' => 'Kemaskini'
        ],
        'revisions' => [

        ],
    ]
];