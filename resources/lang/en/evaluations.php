<?php

return [
    'title' => 'Evaluations',

    'attributes' => [
        'id'            => 'Id',
        'type'          => 'Type',
        'score'         => 'Score',
        'avg_score'     => 'Average Score (%)',
        'evaluation_id' => 'Evaluation Id',
        'notice'        => 'Notice',
        'submission'    => 'Submission',
        'user_id'       => 'Evaluator Id',
        'status'        => 'Status',
        'created_at'    => 'Created At',
        'updated_at'    => 'Last Updated At',
        'evaluator'     => 'Evaluator',
        'type'          => 'Evaluation Type',
        'notice_type'   => 'Notice Type',
        'remarks'       => 'Overall Remarks',
        'required'      => 'Required',
        'requirement'   => 'Requirement',
        'notice_number' => 'Notice No.',
        'organization'  => 'Organization',
        'submitted_at'  => 'Submission Date & Time',
        'overall_percentage' => 'Overall Percentage',
    ],

    'buttons' => [
    ],

    'notices' => [
        'updated' => 'Evaluation updated.',
        'accepted' => '',
    ],

    'views' => [
        'index' => [
            'submissions' => 'Submissions',
        ],
        'show' => [
            'evaluation' => 'Evaluation Details',
            'submission' => 'Vendor Submission'
        ],
        'edit' => [
            'evaluation' => 'My Evaluation',
            'submission' => 'Vendor Submission'
        ],
    ],
];