# Shopify Public App Framework

Use this framework to easily create a public app for the Shopify platform, which utlizes SlimPHP, Eloquent, Twig Templating, and Shopify PHP API Library.

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

* [SlimPHP](https://www.slimframework.com/) - The base framework
* [Eloquent](https://laravel.com/docs/5.5/eloquent) - Database Management
* [Twig](https://twig.symfony.com/doc/2.x/) - View Templating

## Acknowledgments

* Hat tip to SlimPHP, Eloquent, Twig, Shopify PHP Library
