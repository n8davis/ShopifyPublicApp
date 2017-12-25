<?php

namespace App;

use PHPShopify;
class App
{
    CONST NAME     = 'slimTest';
    CONST BASE_URL = 'https://natedavis.me/apps/slimTest/';


    protected $shop;
    protected $config;

    private $appApiKey       = "5c8fb31ceae01652a51a97fa357653ce";
    private $appSharedSecret = "040abec745e2a76038a4c82286451eff";

    /**
     * App constructor.
     * @param $shop
     */
    function __construct( $shop )
    {
        $this->setShop( $shop );
        $this->setConfig([
            'ShopUrl'      => $this->getShop(),
            'ApiKey'       => $this->getAppApiKey(),
            'SharedSecret' => $this->getAppSharedSecret(),
            'AccessToken'  => $this->getShopifyToken(),
        ]);
        PHPShopify\ShopifySDK::config($this->getConfig());
    }

    /**
     * @return array
     */
    public function webhookTopics()
    {
        // CAN BE EDITED DEPENDING ON STORE CONFIGURATION
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

    /**
     * @return null
     */
    public function getShopifyToken()
    {
        if( ! is_null(  \App\Helper::getParam('shop') ) ) {
            $shop = \App\Model\Shop::where('shop', \App\Helper::getParam('shop'))->first();
            return $shop->token;
        }
        return null;
    }

    /**
     * @return string
     */
    public function getAppApiKey(){
        return $this->appApiKey;
    }

    /**
     * @return string
     */
    public function getAppSharedSecret(){
        return $this->appSharedSecret;
    }

    /**
     * @return mixed
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param mixed $shop
     * @return App
     */
    public function setShop($shop)
    {
        $this->shop = $shop;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $config
     * @return App
     */
    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }



}