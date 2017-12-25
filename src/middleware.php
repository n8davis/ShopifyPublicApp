<?php
$checkHmac = function ($request, $response, $next) {
    if( ! App\Auth::verify() ){
        header('Location: ' . \App\App::BASE_URL . 'views/empty');
        die;
    }
    $response = $next($request, $response);
    return $response;
};

$shopExists = function ($request, $response, $next) {
    // BEFORE
//    $response->getBody()->write('AFTER');

    $shop = App\Model\Shop::where( 'shop', \App\Helper::getParam('shop'))->first();
    if( is_null( $shop->shop ) ){
        $currentShop = App\Helper::getParam( 'shop' );
        $app         = new App\App( $currentShop );
        $hmac        = App\Helper::getParam( 'hmac' );
        $timestamp   = App\Helper::getParam( 'timestamp' );

        $scopes      = 'read_products,write_products,read_script_tags,write_script_tags';
        $redirectUrl =  rawurlencode( \App\App::BASE_URL . 'shopify/redirect' );
        \PHPShopify\AuthHelper::createAuthRequest($scopes, $redirectUrl);
        die;
    }
    $response = $next($request, $response);
    // AFTER
//    $response->getBody()->write('AFTER');

    return $response;

};