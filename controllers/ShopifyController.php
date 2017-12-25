<?php
/**
 * Created by PhpStorm.
 * User: nate
 * Date: 12/23/17
 * Time: 4:43 PM
 */

namespace App\Controller;


class ShopifyController
{
    protected $view;

    public function __construct(\Slim\Views\Twig $view) {
        $this->view = $view;
    }

    public function redirect($request, $response, $args)
    {
        $currentShop = \App\Helper::getParam( 'shop');
        $shopifyApp  = new \App\App( $currentShop );
        \PHPShopify\ShopifySDK::config($shopifyApp->getConfig());
        $accessToken = \PHPShopify\AuthHelper::getAccessToken();
        $store       = \App\Model\Shop::firstOrCreate([
            "shop"     => $currentShop,
            "timezone" => "America/Los_Angeles",
            "token"    => $accessToken
        ]);
        $store->save();

        // webhooks
        $shopify = new \PHPShopify\ShopifySDK([
            'ShopUrl'     => $currentShop,
            'AccessToken' => $shopifyApp->getShopifyToken(),
        ]);
        foreach ( $shopifyApp->webhookTopics() as $topic ) {
            \App\Helper::display($shopify->Webhook->post( [
                "topic"   => $topic,
                "address" => \App\App::BASE_URL . 'webhooks/all.php',
                "format"  => "json"
            ]));
        }


        header('Location: https://'.$currentShop.'/admin/apps/');
        die;
    }
}