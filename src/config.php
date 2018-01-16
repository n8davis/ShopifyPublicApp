<?php
$dotenv = new \Dotenv\Dotenv( dirname( __DIR__ ) );
$dotenv->load();
return [
    'determineRouteBeforeAppMiddleware' => false,
    'outputBuffering'                   => false,
    'displayErrorDetails'               => true,
    'db'                                => [  
        'driver'    => 'mysql',
        'host'      => env( 'DB_HOST'),
        'port'      => '22',
        'database'  => env( 'DATABASE' ),
        'username'  => env( 'DB_USER' ),
        'password'  => env( 'DB_PASS' ),
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ]
];