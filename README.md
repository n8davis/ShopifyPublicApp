# Shopify Public App Framework

Use this framework to easily create a public app for the Shopify platform. This framework utlizes SlimPHP, Eloquent, Twig Templating, and Shopify PHP API Library.

## Getting Started

### From the command line

```
composer update
```

## Enter Name and URL path for App
### From /models/App.php
```
CONST NAME     = 'shopifyPublicApp';
CONST BASE_URL = 'https://yourUrl.com/apps/';
```

## Add database connection
### From /src/config.php

```
<?php
return [
    'determineRouteBeforeAppMiddleware' => false,
    'outputBuffering' => false,
    'displayErrorDetails' => true,
    'db' => [
        'driver' => 'mysql',
        'host' => 'localhost',
        'port' => '22',
        'database' => 'database',
        'username' => 'root',
        'password' => 'root',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
    ]
];
```

## Extend Eloquent Class
### From /models/Shop.php
```
<?php
namespace App\Model;
class Shop extends \Illuminate\Database\Eloquent\Model {
    protected $table    = 'shops';
    protected $fillable = ['shop','timezone','whatever'];
}
```
#### Now you can use Eloquent!

## Add Shopify Scopes
### From /src/middleware.php
#### Add the scopes that your app will use to connect to shop
```
$scopes = 'read_products,write_products,read_script_tags,write_script_tags';
```

## Webhooks
### From /models/App.php
#### Edit the array to so that the appropriate webhook topics will be created
```
/**
 * @return array
 */
public function webhookTopics()
{
    // EDIT DEPENDING ON STORE CONFIGURATION
    return [
        'app/uninstalled','draft_orders/create', 'draft_orders/delete',
        'draft_orders/update', 'fulfillments/create', 'fulfillments/update',
        'fulfillment_events/create', 'fulfillment_events/delete',
        'orders/cancelled', 'orders/create', 'orders/delete',
        'orders/fulfilled', 'orders/paid', 'orders/partially_fulfilled', 'orders/updated',
        'order_transactions/create', 'products/create', 'products/delete', 'products/update',
        'product_listings/add', 'product_listings/remove', 'product_listings/update',
        'refunds/create'
    ];
}
```

## Register Your Controllers
### From /src/dependencies.php
#### The namespace for this controller is App\Controller\YourController
```
$container['App\Controller\YourController'] = function($c) {
    $view = $c->get("view"); // retrieve the 'view' from the container
    return new App\Controller\YourController($view);
};

```

## Display view
### From /src/dependencies.php
#### Configure the location of your view directory. The example is in /views
```
$container['view'] = function ($c) {
    $basePath = App\App::BASE_URL . DIRECTORY_SEPARATOR . 'views/';
    $view = new \Slim\Views\Twig(dirname(__DIR__). DIRECTORY_SEPARATOR . 'views/');

    // Instantiate and add Slim specific extension
     $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};
```
### From /controllers/HomeController.php 
#### Your view will have {{ users }} as a variable 
```
public function emptyView($request, $response, $args) {
    return $this->view->render($response, 'empty.php', [
        'users' => ['Nate', 'Lee', 'Davey']
    ]);
}
```

## Namespaces
### From /composer.json
#### Add your namespaces however you like
```
"autoload": {
    "psr-4": {
        "App\\": "models",
        "App\\Model\\": "models",
        "App\\Controller\\": "controllers"
    }
}
```

## Setup Shopify
### From /views/assets/js/shopify.js
```
ShopifyApp.init({
    apiKey: "", // add your own app api key
    shopOrigin: "", // add the client shop here 
    debug: false,
    forceRedirect: true
});
```
## Acknowledgments
* Hat tip to SlimPHP, Eloquent, Twig, Shopify PHP Library

* [SlimPHP](https://www.slimframework.com/) - The base framework
* [Eloquent](https://laravel.com/docs/5.5/eloquent) - Database Management
* [Twig](https://twig.symfony.com/doc/2.x/) - View Templating
* [Shopify PHP Library](https://github.com/phpclassic/php-shopify) - Shopify API
