<?php

return [
    'title' => 'Evaluations',

    'attributes' => [
        'id' => 'Id',
        'type' => 'Type',
        'evaluation_id' => 'Evaluation Id',
        'user_id' => 'Evaluator Id',
        'status' => 'Status',
        'created_at' => 'Created At',
        'updated_at' => 'Last Updated At',
    ],

    'buttons' => [
        'create' => 'Create New Evaluation',
        'edit' => 'Edit Evaluation',
        'all' => 'All Evaluations',
        'my_evaluations' => 'My Evaluations',
    ],

    'notices' => [
        'created' => 'Evaluation score created.',
        'updated' => 'Evaluation score updated.',
        'deleted' => 'Evaluation :name deleted.',
        'activated' => 'Evaluation :name activated.',
        'deactivated' => 'Evaluation :name deactivated.',
        'published' => 'Evaluation :name published.',
        'unpublished' => 'Evaluation :name unpublished.',
    ],
    
    'views' => [
        'index' => [
            'title' => 'Evaluations',
            'keywords' => 'Keywords',
            'status' => 'Status',
        ],
        'show' => [
            'title' => 'View',
        ],
        'create' => [
            'title' => 'New',
        ],
        'edit' => [
            'title' => 'Edit',
        ],
        'revisions' => [

        ],
        'my_evaluations' => [
            'title' => 'My Evaluations'
        ],
        'submission' => [
            'title' => 'Submission'
        ],
        'commercial' => [
            'title' => 'Commercial Requirements'
        ],
        'technical' => [
            'title' => 'Technical Requirements'
        ],
        'settings' => [
            'title' => 'Settings'
        ],
    ],
];