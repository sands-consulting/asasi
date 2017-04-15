<?php

return [
    'title' => 'Cart',

    'attributes' => [
        'item' => 'Item',
        'price' => 'Price',
        'tax' => 'Tax',
        'total' => 'Total',
        'sub_total' => 'Sub Total'
    ],

    'buttons' => [
        'payment' => 'Proceed to Payment'
    ],

    'notices' => [
        'added' => 'Item :name has been added to the cart.',
        'removed' => 'Item :name has been removed.',
        'destroyed' => 'Cart successfully cancelled.'
    ],

    'views' => [
        'index' => [
            'empty' => 'No item in cart'
        ]
    ]
];
