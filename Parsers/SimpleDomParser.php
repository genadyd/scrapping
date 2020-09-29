<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 9/29/20
 * Time: 7:23 AM
 */


namespace Parsers;
require_once 'Parsers/ParserInterface.php';

final class SimpleDomParser implements ParserInterface
{
    private $html;
    public function __construct($html)
    {
        $this->html = $html;
    }

    public function getHrefsArray()
    {
       $dom = new \DOMDocument();
       @$dom->loadHTML($this->html);
      $links =  $dom->getElementsByTagName('a');
      $urls_array = array();
      foreach ($links as $link){
          $href = $link->getAttribute('href');
          if(!empty($href)){
              $href = trim($href,'/');
              $urls_array[] = $href;
          }

      }
       return $urls_array;
    }
}
