<?php

return [
    'title' => 'Evaluation Checklist',

    'attributes' => [
        'id' => 'Id',
        'title' => 'Title',
        'full_score' => 'Full Score',
        'type_id' => 'Evaluation Type',
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
        'settings' => [
            'title' => 'Settings'
        ],
    ],
];