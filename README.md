# Shopify Public App Framework

Use this framework to easily create a public app for the Shopify platform. This framework utlizes SlimPHP, Eloquent, Twig Templating, and Shopify PHP API Library.

## Getting Started

### From the command line

```
composer update
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
        'app/uninstalled',"carts/create", "carts/update",'checkouts/create',
        'checkouts/delete', 'checkouts/update','collections/create',
        'collections/delete', 'collections/update','collection_listings/add',
        'collection_listings/remove', 'collection_listings/update',
        'customers/create', 'customers/delete', 'customers/disable', 'customers/enable',
        'customers/update','customer_groups/create','customer_groups/delete',
        'customer_groups/update', 'draft_orders/create', 'draft_orders/delete',
        'draft_orders/update', 'fulfillments/create', 'fulfillments/update',
        'fulfillment_events/create', 'fulfillment_events/delete',
        'orders/cancelled', 'orders/create', 'orders/delete',
        'orders/fulfilled', 'orders/paid', 'orders/partially_fulfilled', 'orders/updated',
        'order_transactions/create', 'products/create', 'products/delete', 'products/update',
        'product_listings/add', 'product_listings/remove', 'product_listings/update',
        'refunds/create','shop/update','themes/create', 'themes/delete', 'themes/publish',
        'themes/update'
    ];
}
```

* [SlimPHP](https://www.slimframework.com/) - The base framework
* [Eloquent](https://laravel.com/docs/5.5/eloquent) - Database Management
* [Twig](https://twig.symfony.com/doc/2.x/) - View Templating
* [Shopify PHP Library](https://github.com/phpclassic/php-shopify) - Shopify API

## Acknowledgments

* Hat tip to SlimPHP, Eloquent, Twig, Shopify PHP Library
