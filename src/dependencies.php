<?php
// DIC configuration

$container = $app->getContainer();
// Register Twig View helper
$container['view'] = function ($c) {
    $basePath = App\App::BASE_URL . DIRECTORY_SEPARATOR . 'views/';
    $view = new \Slim\Views\Twig(dirname(__DIR__). DIRECTORY_SEPARATOR . 'views/');

    // Instantiate and add Slim specific extension
     $view->addExtension(new \Slim\Views\TwigExtension($c['router'], $basePath));

    return $view;
};
// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};
$container['App\Controller\HomeController'] = function($c) {
    $view = $c->get("view"); // retrieve the 'view' from the container
    return new App\Controller\HomeController($view);
};
$container['App\Controller\ShopifyController'] = function($c) {
    $view = $c->get("view"); // retrieve the 'view' from the container
    return new App\Controller\ShopifyController($view);
};