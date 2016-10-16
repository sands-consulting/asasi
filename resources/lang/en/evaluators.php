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

    'buttons' => [],

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
            'title' => 'Evaluators',
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
        'settings' => [
            'title' => 'Settings'
        ],
        'assign' => [
            'title' => 'Assign Evaluator'
        ],
    ],
];