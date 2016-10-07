<?php

return [
	'views' => [
		'index' => [
            'title' => 'Home',
			'panels' => [
				'news' => [
                    'title' => 'Recent News'
				],
                'vendors' => [
                    'title' => 'Vendors Application Status',
                    'registration_status' => 'Registration Status',
                    'paritcipation' => 'Top Participation',
                    'status' => 'Vendor Status'
                ],
                'notices' => [
                    'title' => 'Notices'
                ],
                'login' => [
                    'activity' => 'Login Activity',
                    'last' => 'Last Login'
                ],
                'users' => [
                    'title' => 'User List'
                ]
			]
		]
	]
];
