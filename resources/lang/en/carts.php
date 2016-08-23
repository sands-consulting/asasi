<?php

return [
	'views' => [
		'index' => [
			'panels' => [
				'news' => [
					'title' => 'Recent News'
				],
                'vendors' => [
                    'title' => 'Vendors Application Status'
                ],
                'notices' => [
                    'title' => 'Notices'
                ]
			],
            'empty' => 'Cart is empty.'
		]
	],
    'buttons' => [
        'proceed_to_payment' => 'Proceed to Payment'
    ],
    'notices' => [
        'added' => 'Item :name has been added to the cart',
        'removed' => 'Item :name has been removed'
    ]
];
