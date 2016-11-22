<?php

return [
    'title' => 'Evaluation Checklist',

    'attributes' => [
        'id' => 'Id',
        'score' => 'Score',
        'score_average' => 'Score Average',
        'evaluation_requirement_id' => 'Evaluation Requirement',
        'submission_id' => 'Submission',
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