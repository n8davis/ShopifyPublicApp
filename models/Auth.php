<?php
/**
 * Created by PhpStorm.
 * User: nate
 * Date: 12/23/17
 * Time: 3:06 PM
 */

namespace App;


class Auth
{
    protected $scopes;

    
    public static function verify()
    {
        if (  is_null( \PHPShopify\ShopifySDK::$config['SharedSecret'] ) && is_null( \PHPShopify\ShopifySDK::$config['AccessToken']) ){
            throw new \Exception('Shopify Config not set');
        }
        $data   = $_GET;
        $params = array();

        foreach($data as $param => $value) {
            if ($param != 'signature' && $param != 'hmac' ) {
                $params[$param] = "{$param}={$value}";
            }
        }

        asort($params);
        $params = implode('&', $params);

        $hmac           = $data['hmac'];
        $calculatedHmac = hash_hmac('sha256', $params,  \PHPShopify\ShopifySDK::$config['SharedSecret']);

        return ($hmac == $calculatedHmac);
    }

    public function setAuthScopes( $scopes )
    {
        [
        "content" => ["read_content", "write_content"],
        "themes"  => ["read_themes", "write_themes"],
        "products" => ["read_products", "write_products"],
        "product_listings" => ["read_product_listings"],
        "collection_listings" => ["read_collection_listings"],
        "customers" => ["read_customers", "write_customers"],
        "orders" => ["read_orders", "write_orders"],
        "draft_orders" => ["read_draft_orders", "write_draft_orders"],
        "script_tags" => ["read_script_tags", "write_script_tags"],
        "fulfillment" => ["read_fulfillments", "write_fulfillments"],
        "shipping" => ["read_shipping", "write_shipping"],
        "analytics" => ["read_analytics"],
        "users" => ["read_users", "write_users"],
        "checkouts" => ["read_checkouts", "write_checkouts"],
        "reports" => ["read_reports", "write_reports"],
        "price_rules" => ["read_price_rules", "write_price_rules"],
        "marketing_events" =>["read_marketing_events", "write_marketing_events"],
        "resource_feedbacks" => ["read_resource_feedbacks", "write_resource_feedbacks"],
        "unauthenticated_read_collection_listings" => ["unauthenticated_read_collection_listings"],
         "unauthenticated_read_product_listings" =>  ["unauthenticated_read_product_listings"],
        "unauthenticated_write_checkouts" => ["unauthenticated_write_checkouts"],
        "unauthenticated_write_customers" => ["unauthenticated_write_customers"]
        ];
    }

    /**
     * @return mixed
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @param mixed $scopes
     * @return Auth
     */
    public function setScopes($scopes)
    {
        $this->scopes = $scopes;
        return $this;
    }

}