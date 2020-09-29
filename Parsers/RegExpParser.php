<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 9/25/20
 * Time: 10:51 AM
 */


namespace Parsers;
require_once 'Parsers/ParserInterface.php';

final class RegExpParser implements ParserInterface{
    private $html;
    public function __construct($html)
    {
        $this->html = $html;
    }

    public function getHrefsArray()
    {
        $res_array = [];
        /*find anchors ------------*/
        $anchors_pattern = '/<a[^<>]*href="([^<>#"\s]+)"[^<>]*>/i';
        $a_find = preg_match_all($anchors_pattern, $this->html, $matches);
        foreach ($matches[1] as $a){
            $a = trim($a,'/');
            if(!in_array($a,$res_array )){
                $res_array[]=$a;
            }
        }
       return $res_array;
    }
}

