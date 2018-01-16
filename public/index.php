<?php

require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'handlers/exceptions.php';

$config     = include( dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'src/config.php' );

$app        = new \Slim\App(['settings'=> $config]);
	
// Set up dependencies
require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . '/src/dependencies.php';

// Register middleware
require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . '/src/middleware.php';

// Register capsule
require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . '/src/capsule.php';

// Register routes
require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . '/src/routes.php';

// Register Shopify Credentials
$shopifyApp = new App\App( App\Helper::getParam( 'shop' ) );

$app->run();