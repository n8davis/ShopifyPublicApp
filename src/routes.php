<?php

$app->get('/', \App\Controller\HomeController::class . ':home')->add($shopExists)->add($checkHmac);

$app->get('/shopify/redirect', \App\Controller\ShopifyController::class . ':redirect');

$app->get('/empty', \App\Controller\HomeController::class . ':emptyView');

