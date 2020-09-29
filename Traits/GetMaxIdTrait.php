<?php


namespace Traits;


trait GetMaxIdTrait
{
    /*
     * !!!
     * before call this func check if array not Empty
     * */
   public function getMaxId($links_array){
       $max_id = 0;
       if(count($links_array)>0) {
           foreach ($links_array as $link) {
               if ($link['id'] > $max_id) $max_id = $link['id'];
           }
       }
           return $max_id;
   }
}
