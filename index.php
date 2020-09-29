<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 9/24/20
 * Time: 4:10 PM
 */

use Controllers\MainController;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require_once 'Controllers/MainController.php';
$main_controller = new MainController('http://www.lordbingo.co.uk');
$main_controller->startModule();
