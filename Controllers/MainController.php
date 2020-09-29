<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 9/24/20
 * Time: 6:04 PM
 */


namespace Controllers;


use Db\MySql;
use HtmlGetters\CurlHtmlGetter;
use HtmlGetters\FileGetContentGetter;
use Parsers\RegExpParser;
use ResUrls\ResUrls;
use TempUrls\TempUrls;

require 'TempUrls/TempUrls.php';
require 'ResUrls/ResUrls.php';
require 'HtmlGetters/CurlHtmlGetter.php';
require 'HtmlGetters/FileGetContentGetter.php';
require_once 'Db/MySql.php';

class MainController
{
    private $init_url ;
    private $init_url_array;
    private $observer;
    private static $counter = 0;
    public function __construct($init_url)
    {
        $this->init_url = $init_url;
        $this->init_url_array = array( ['id'=>1, 'parent'=>0, 'url' => $this->init_url] );
        $this->temp_url = new TempUrls();
        $this->res_url = new ResUrls();
        $this->observer = function () { $this->runRecursion(); }; /*observer anonymous function for run controller from getter */
    }
/*
 * start process
 *
 * */
    public function startModule():void
    {
        /*truncate db table */
        $t_db = new MySql();
        $t_db->trunateUrlsTable();
//      $getter = new CurlHtmlGetter( $this->init_url_array , $this->temp_url, $this->res_url);
        $getter = new FileGetContentGetter( $this->init_url_array , $this->temp_url, $this->res_url);
        $getter->getData( $this->observer, self::$counter );

    }
/*
 * recursion
 * */
    public function runRecursion()
    {
        $temp_links_object = $this->temp_url->TempGetResArray();
        if(self::$counter<3){
            $getter = new CurlHtmlGetter( $temp_links_object , $this->temp_url, $this->res_url);
            $getter->getData( $this->observer, self::$counter );
        }
        else{
            echo 'processing ended';
        }

    }
}
