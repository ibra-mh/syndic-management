<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Syndic Management Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration settings for the syndic management system including
    | cotisation amounts, validation rules, and business logic settings.
    |
    */

    'cotisations' => [
        'default_amounts' => [
            'appartement' => env('SYNDIC_DEFAULT_APPARTEMENT_AMOUNT', 2000.00),
            'garage' => env('SYNDIC_DEFAULT_GARAGE_AMOUNT', 500.00),
            'boxe' => env('SYNDIC_DEFAULT_BOXE_AMOUNT', 300.00),
        ],
        
        'full_payment_threshold' => env('SYNDIC_FULL_PAYMENT_THRESHOLD', 3000.00),
        
        'validation' => [
            'min_year' => env('SYNDIC_MIN_YEAR', 2020),
            'max_year_offset' => env('SYNDIC_MAX_YEAR_OFFSET', 1), // Current year + offset
            'min_amount' => env('SYNDIC_MIN_AMOUNT', 0),
            'max_amount' => env('SYNDIC_MAX_AMOUNT', 50000),
        ],
    ],

    'depenses' => [
        'validation' => [
            'min_year' => env('SYNDIC_MIN_YEAR', 2020),
            'max_year_offset' => env('SYNDIC_MAX_YEAR_OFFSET', 1),
            'min_amount' => env('SYNDIC_MIN_AMOUNT', 0),
            'max_amount' => env('SYNDIC_MAX_AMOUNT', 100000),
        ],
        
        'upload' => [
            'max_file_size' => env('SYNDIC_MAX_FILE_SIZE', 2048), // KB
            'allowed_extensions' => ['jpg', 'jpeg', 'png', 'pdf'],
            'storage_path' => 'factures',
        ],
    ],

    'buildings' => [
        'validation' => [
            'max_etages' => env('SYNDIC_MAX_ETAGES', 50),
            'max_appartements' => env('SYNDIC_MAX_APPARTEMENTS', 500),
        ],
    ],

    'pagination' => [
        'per_page' => env('SYNDIC_PAGINATION_PER_PAGE', 15),
        'admin_per_page' => env('SYNDIC_ADMIN_PAGINATION_PER_PAGE', 10),
    ],

    'currency' => [
        'symbol' => env('SYNDIC_CURRENCY_SYMBOL', 'DH'),
        'position' => env('SYNDIC_CURRENCY_POSITION', 'after'), // 'before' or 'after'
        'decimal_places' => env('SYNDIC_CURRENCY_DECIMAL_PLACES', 2),
    ],
];