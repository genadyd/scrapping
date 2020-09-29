<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 9/26/20
 * Time: 11:12 PM
 */


namespace ResUrls;
use Traits\GetMaxIdTrait;
require_once 'Traits/GetMaxIdTrait.php';
require_once 'ResUrlsInterface.php';
/*
 * object for save results links array
 *
 *
 * */

final class ResUrls implements ResUrlsInterface
{
    use GetMaxIdTrait;
    private static $res_array = array();
    function resUrlPush(array $url_obj)
    {
        if($this->checkIsUnique($url_obj)){
            array_push(self::$res_array, $url_obj);
        }
    }

    function getResUrl()
    {
        return self::$res_array;
    }
    public function checkIsUnique($value){
        $flag = true;
        foreach (self::$res_array as $url){
            if($url['url']===$value){
                $flag = false;
                return;
            }
        }
        return $flag;

    }
}
