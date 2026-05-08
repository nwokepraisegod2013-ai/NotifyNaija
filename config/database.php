<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection
    |--------------------------------------------------------------------------
    */
    'default' => env('DB_CONNECTION', 'pgsql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    */
    'connections' => [

        'pgsql' => [
            'driver' => 'pgsql',

            // ❌ DO NOT use DATABASE_URL (causes conflicts on Render)
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT', 5432),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),

            'charset' => 'utf8',
            'prefix' => '',
            'schema' => 'public',

            // Render-safe SSL requirement
            'sslmode' => 'require',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migrations Table
    |--------------------------------------------------------------------------
    */
    'migrations' => [
        'table' => 'migrations',
    ],

    /*
    |--------------------------------------------------------------------------
    | Redis (DISABLED FOR PRODUCTION STABILITY)
    |--------------------------------------------------------------------------
    */
    'redis' => [

        // ⚠️ Disabled fallback behavior
        'client' => null,

        'default' => null,
        'cache' => null,

    ],

];