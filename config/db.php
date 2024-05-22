<?php
return [

    'driver' => env('DB_DRIVER','pdo_sqlite'),

    'server'=>[
        'mysql'=>[
            'host'=>'localhost',
        ],
        'pdo_sqlite'=>[
            'driver' => 'sqlite',
            'url' => env('DB_URL', 'localhost'),
            'database' => env('DB_DATABASE', database_path(env('DB_NAME', 'database.sqlite'))),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),

        ]
    ]
];