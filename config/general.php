<?php
return [
    'project_types' => [
        'audio',
        'video',
        'photo',
    ],
    'task' => [

        /*
        |--------------------------------------------------------------------------
        | Статусы задачи (task.status)
        |--------------------------------------------------------------------------
        |
        | Используеются при создании задачи, фильтрации
        | сортировке внутри личного кабинета.
        |
        */

        'status' => [

            'new' => 'New',
            'rejected' => 'Rejected',
//            'claimed' => 'Claimed',
            'in_progress' => 'In Progress',
            'delivered' => 'Delivered',
            'checked' => 'Checked',
            'approved' => 'Approved',
            'ready_to_invoice' => 'Ready to invoice',
            'invoiced' => 'Invoiced',

        ],

    ],

    'project' => [

        'status' => [
            'new' => 'New',
            'accepted' => 'Accepted',
            'delivered' => 'Delivered',
            'in_progress' => 'In Progress',
            'completed' => 'Completed'
        ]

    ],

    'invoice' => [
        'status' => [
            'pending' => 'Pending',
            'paid' => 'Paid'
        ]
    ],

    // User profile type

    'user_types' => ['admin', 'project_manager', 'speaker'],

    // Language levels

    'language' => [
        'levels' => [
            0 => 'basic',
            1 => 'intermediate',
            2 => 'fluent',
            3 => 'native'
        ]
    ],

    // Files types

    'files' => [
        'cv',
        'rules',
        'script',
        'image',
        'audio',
        'avatar'
    ],

    // Voices by age

    'voice_types' => [
        'Child',
        'Teen',
        'Adult',
        'Old'
    ],

    'time_types' => [
        'Sec',
        'Min',
        'Hour',
    ],

    'languages' => [
        'en' => 'English',
        'ru' => 'Russian',
        'sp' => 'Spanish',
        'fr' => 'Franch',
        'ro' => 'Romanian',
    ],

    'audio_formats' => [
        'ogg',
        'wav',
        'mp3'
    ]
];
