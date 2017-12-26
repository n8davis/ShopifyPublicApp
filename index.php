<?php
require 'vendor/autoload.php';
require 'handlers/exceptions.php';

$config     = include('src/config.php');

$app        = new \Slim\App(['settings'=> $config]);

// Set up dependencies
require __DIR__ . '/src/dependencies.php';

// Register middleware
require __DIR__ . '/src/middleware.php';

// Register capsule
require __DIR__ . '/src/capsule.php';

// Register routes
require __DIR__ . '/src/routes.php';

// Register Shopify Credentials
$shopifyApp = new App\App( App\Helper::getParam( 'shop') );

$app->run();