<?php

return [
    'guards' => [
        'user'   => [
            'driver'   => 'user',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users'   => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
        ],
    ],
];
