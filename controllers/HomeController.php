<?php

namespace App\Controller;


class HomeController
{
    protected $view;

    public function __construct(\Slim\Views\Twig $view) {
        $this->view = $view;
    }

    public function home($request, $response, $args) {
        $shopifyApp = new \App\App( \App\Helper::getParam('shop') );
        return $this->view->render($response, 'home/index.php', [
            'url'    => \App\App::NAME,
            'apiKey' => $shopifyApp->getAppApiKey(),
            'shop'   => $shopifyApp->getShop()
        ]);
    }

    public function emptyView($request, $response, $args) {
        return $this->view->render($response, 'empty.php', []);
    }
}