<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 9/24/20
 * Time: 6:05 PM
 */


namespace TempUrls;

/*
 * TempUrls object
 *  for save urls returned by parser
 * vars:
 *  res_urls_array:private, assoc array
 *
 * methods:
 *  @ public TempResPush : void -- set new value into "res_urls_array"
 *  @ public TempGetResArray : array --  get and retrieve "res_urls_array"
 *  @ private CheckIsNotUniq : boolean -- check if url not exists in "res_urls_array"
 * */

use Traits\GetMaxIdTrait;

require_once 'TempUrlsInterface.php';
require_once 'Traits/GetMaxIdTrait.php';
final class TempUrls implements TempUrlsInterface
{
//    use GetMaxIdTrait;
    private  $temp_urls_array ;

    public function __construct()
    {
        $this->temp_urls_array = array();
    }

    public function TempResPush($val):void
    {
        if($this->CheckIsUniq($val['url'])) {
            array_push($this->temp_urls_array, $val );
        }
    }
    public function TempGetResArray():array
    {
        return $this->temp_urls_array;
    }

    private function CheckIsUniq($val):bool /*return false if in array exists and true if is not*/
    {
        $flag = true;
        foreach ($this->temp_urls_array as $url){
            if($url['url']===$val){
                $flag = false;
                break;
            }
        }
        return $flag;
    }


}
