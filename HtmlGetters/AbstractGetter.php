<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 9/27/20
 * Time: 9:09 AM
 */


namespace HtmlGetters;


 use Parsers\RegExpParser;
 use Parsers\SimpleDomParser;
 use ResUrls\ResUrlsInterface;
 use TempUrls\TempUrlsInterface;
 use Traits\GetMaxIdTrait;

 require_once 'Traits/GetMaxIdTrait.php';
 require_once 'HtmlGettersInterface.php';
 require_once 'Parsers/RegExpParser.php';
 require_once 'Parsers/SimpleDomParser.php';

 abstract class AbstractGetter implements HtmlGettersInterface
{
     use GetMaxIdTrait;
     protected $urls ;
     protected $temp_urls_object;
     protected $res_urls_object;


     public function __construct( array $urls,
                                  TempUrlsInterface $temp_urls_object,
                                  ResUrlsInterface $res_urls_object )
     {
         $this->urls = $urls;
         $this->temp_urls_object = $temp_urls_object;
         $this->res_urls_object = $res_urls_object;
     }
     protected function htmlParse($html){
         /* here is possible to change the parser class */
         $parser = new SimpleDomParser($html); /* delegate get links to "SimpleDomParser" */
        /*$parser = new RegExpParser($html);*/ /* delegate get links to "RegExpParser" */
         return  $parser->getHrefsArray();
     }
     protected function tempArrayPushing($links_collection, $parent){
         foreach($links_collection as $link){
             $temp_object = $this->temp_urls_object->TempGetResArray();
             if(count($temp_object)>0){
                 $id = $this->getMaxId($temp_object); /*method "getMaxId" created in Traits/GetMaxIdTrait.php*/
             }else{
                 $id = $this->getMaxId($this->res_urls_object->getResUrl()); /*method "getMaxId" created in Traits/GetMaxIdTrait.php*/
             }
             $this->temp_urls_object->TempResPush(array(
                 'id'=>$id+1,
                 'parent'=>$parent,
                 'url'=>$link
             ));
         }

     }
}
