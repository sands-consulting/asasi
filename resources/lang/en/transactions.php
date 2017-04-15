<?php

return [
    'title' => 'Transactions',

    'attributes' => [
        'transaction_number' => 'Transaction No.',
        'invoice_number' => 'Invoice No.',
        'gateway' => 'Payment Gateway',
        'created_at' => 'Date',
        'paid_at' => 'Payment Date',
        'status' => 'Status',
        'item' => 'Item',
        'price' => 'Price',
        'tax' => 'Tax',
        'total' => 'Total',
        'sub_total' => 'Sub Total',
        'user' => 'User',
        'payer' => 'Payer'
    ],

    'buttons' => [
        'download-invoice' => 'Download Invoice',
        'download-statement' => 'Download Statement'
    ],

    'notices' => [
        'e1' => 'Unable to find your transaction',
        'e2' => 'Unable to process your payment',
        'e3' => 'Gateway unable to process your payment',

        'x1' => 'Unable to retrieve your transaction (Code: X1)',
        'x2' => 'Unable to process your payment (Code: X2)',
        'x3' => 'Invalid payment gateway transaction (Code: X3)',
        'x4' => 'Invalid payment gateway data (Code: X4)'
    ],

    'description' => 'Payment for Transaction at :name',

    'views' => [
        'admin' => [
            'index' => [
                'search' => [
                    'keywords' => 'Keywords',
                    'status' => 'Status',
                ]
            ],
            'invoice' => [
                'title' => 'Invoice',
                'payer' => 'Invoice To'
            ],
            'statement' => [
                'title' => 'Statement',
                'payer' => 'Statement For'
            ]
        ],
        'show' => [
            'title' => 'Transaction Status',
        ],
        'error' => [
            'title' => 'Transaction Error'
        ]
    ]
];
