<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'nasabah' => [
            'driver' => 'session',
            'provider' => 'nasabahs',
        ],

        'bank_sampah_unit' => [
            'driver' => 'session',
            'provider' => 'bank_sampah_unit_accounts',
        ],

        'bank_sampah_pusat' => [
            'driver' => 'session',
            'provider' => 'bank_sampah_pusat_accounts',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        'nasabahs' => [
            'driver' => 'eloquent',
            'model' => App\Models\Nasabah::class,
        ],

        'bank_sampah_unit_accounts' => [
            'driver' => 'eloquent',
            'model' => App\Models\BankSampahUnitAccount::class,
        ],

        'bank_sampah_pusat_accounts' => [
            'driver' => 'eloquent',
            'model' => App\Models\BankSampahPusatAccount::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'nasabahs' => [
            'provider' => 'nasabahs',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'bank_sampah_unit_accounts' => [
            'provider' => 'bank_sampah_unit_accounts',
            'table' => 'password_resets',
            'expire' => 60,
        ],

        'bank_sampah_pusat_accounts' => [
            'provider' => 'bank_sampah_pusat_accounts',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];
