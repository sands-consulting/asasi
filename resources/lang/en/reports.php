<?php

return [
    'title' => 'Reports',

    'back' => 'All Reports',

    'attributes' => [
        'year' => 'Year',
        'month' => 'Month',
        'status' => 'Status',
        'vendor_type' => 'Vendor Type',
        'qualifications' => 'Qualifications'
    ],

    'titles' => [
        'vendor' => 'Vendor',
        'allocation' => 'Allocation',
        'notice' => 'Notice',
        'subscription' => 'Subscription',
        'transaction' => 'Transaction',
        'evaluation' => 'Evaluation'
    ],

    'reports' => [
        'vendor' => [
            'rv1' => 'List of Vendors',
            'rv2' => 'List of New Vendors',
            'rv3' => 'List of Blacklisted Vendors',
            'rv4' => 'Summary of Vendor by Type',
            'rv4' => 'Summary of Vendor by Region',
            'rv5' => 'Summary of Notice Participated by Vendor',
            'rv6' => 'Summary of Notice Awarded by Vendor'
        ],

        'allocation' => [
            'ra1' => 'List of Allocations',
            'ra2' => 'Summary of Allocations',
        ],

        'notice' => [
            'rn1' => 'List of Notice',
            'rn2' => 'Summary of Notice',
            'rn3' => 'Notice Activities',
            'rn4' => 'Notice Eligblities',
            'rn5' => 'Notice Invitations',
            'rn6' => 'Notice Purchases',
            'rn7' => 'Notice Submissions',
            'rn8' => 'Notice Evaluations'
        ],

        'subscription' => [
            'rs1' => 'List of Subscriptions',
            'rs2' => 'Summary of Subscriptions'
        ],

        'transaction' => [
            'rt1' => 'Daily Transactions',
            'rt2' => 'Monthly Transactions',
            'rt3' => 'Summary of Transactions'
        ],

        'evaluation' => [
            're1' => 'List of Evaluations',
            're2' => 'Summary of Notice & Evaluations',
            're3' => 'Summary of Evaluator & Evaluations',
        ]
    ]
];