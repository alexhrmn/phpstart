<?php


 // FRONT CONTROLLER


 // 1. Default settings
 ini_set ('display_errors',1);
 error_reporting(E_ALL);

 // 2. Conecting system files
 define ('ROOT', dirname (__FILE__));
 require_once (ROOT.'/components/Router.php');


 // 3. Conect


 // 4. Router
$router = new Router();
$router->run();
