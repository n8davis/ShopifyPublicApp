<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
$config     = include(dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'src/config.php');
$app        = new \Slim\App(['settings'=> $config]);
require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'src/dependencies.php';
require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'src/middleware.php';
require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'src/capsule.php';
require dirname( __DIR__ ) . DIRECTORY_SEPARATOR . 'src/routes.php';

$data        = file_get_contents('php://input');
$shop        = null;
$topic       = null;
$hmac_header = null;
$shopifyObj  = json_decode( $data );

foreach (getallheaders() as $name => $value) {

    if ($name == 'X-Shopify-Shop-Domain') {
        $shop        = trim($value);
    }
    if ($name == 'X-Shopify-Topic') {
        $topic       = trim($value);
    }
    if ($name == 'X-Shopify-Hmac-Sha256') {
        $hmac_header = trim($value);
    }
}

switch ($topic) {
    case $topic === 'app/uninstalled':
        $store = \App\Model\Shop::where( 'shop', $shop )->first();
        if( ! is_null( $store ) ) {
            $store = \App\Model\Shop::find($store->id);
            $store->delete();
        }
        break;
}
