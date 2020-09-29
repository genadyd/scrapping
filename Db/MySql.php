<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 9/27/20
 * Time: 11:25 AM
 */


namespace Db;


use PDO;

class MySql
{
    private $db;
    public function __construct(){
        $this->getConnection();
    }
   private function getConnection(){
       $host = 'localhost';
       $user = 'root';
       $db = 'scrapping';
       $pass = '';
       $this->db = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
       $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   }
   public function linkInsert($link_obj){
        $query  = "INSERT INTO urls (id, app_id, parent_id, status, counter, redirect, url, real_url )
                   VALUES (:APP_ID, :APP_ID, :PARENT_ID, :STATUS, :COUNTER, :REDIRECT, :URL,  :REAL_URL)";
       $st = $this->db->prepare($query);
       $redirect = (trim($link_obj['url']) != trim($link_obj['real_url'],'/'));
//       $redirect = false;
       $st->bindParam(':APP_ID',$link_obj['id'], PDO::PARAM_INT);
       $st->bindParam(':PARENT_ID',$link_obj['parent'], PDO::PARAM_INT);
       $st->bindParam(':STATUS',$link_obj['status'], PDO::PARAM_INT);
       $st->bindParam(':COUNTER',$link_obj['counter'],PDO::PARAM_INT);
       $st->bindParam(':REDIRECT',$redirect,PDO::PARAM_BOOL);
       $st->bindParam(':URL',$link_obj['url'], PDO::PARAM_STR);
       $st->bindParam(':REAL_URL',$link_obj['real_url'], PDO::PARAM_STR);
       $st->execute();
   }
   public function trunateUrlsTable(){
         $query = "TRUNCATE TABLE urls";
         $this->db->query($query);
   }
}
