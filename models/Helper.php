<?php
/**
 * Created by PhpStorm.
 * User: nate
 * Date: 12/23/17
 * Time: 11:25 AM
 */

namespace App;


class Helper
{

    public static function display( $data , $die = false ){
        echo '<pre>'; var_dump( $data ); echo '</pre>';
        if( $die ) die;
    }

    public static function getParam( $param ){
        if( array_key_exists( $param, $_REQUEST ) ){
            return $_REQUEST[ $param ];
        }
        return null;
    }
}