<?php

return [
    'title' => 'Evaluators',

    'attributes' => [
        'id' => 'Id',
        'title' => 'Title',
        'full_score' => 'Full Score',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'accept' => 'Accept',
        'decline' => 'Decline',
    ],

    'notices' => [
        'created' => 'Evaluator score created.',
        'updated' => 'Evaluator score updated.',
        'deleted' => 'Evaluator :name deleted.',
        'activated' => 'Evaluator :name activated.',
        'deactivated' => 'Evaluator :name deactivated.',
        'accepted' => 'Evaluator request for notice :number accepted.',
        'declined' => 'Evaluator request for notice :number declined.',
        'assigned' => 'Submission has been assigned to evaluator'
    ],
    
    'views' => [
        'index' => [
            'title' => 'Evaluators',
            'keywords' => 'Keywords',
            'status' => 'Status',
        ],
        'show' => [
            'title' => 'View',
        ],
        'create' => [
            'title' => 'Add Evaluator(s)',
        ],
        'edit' => [
            'title' => 'Edit',
            'info' => 'A notification will be sent to the selected evaluator for approval.',
        ],
        'revisions' => [

        ],
        'settings' => [
            'title' => 'Settings'
        ],
        'assign' => [
            'title' => 'Assign Evaluator'
        ],
        'request' => [
            'title' => 'Evaluator\'s Request',
            'panels' => [
                'notice' => 'Notice Details',
                'action' => 'Evaluator\'s Acceptance',
            ]
        ],
    ],
];