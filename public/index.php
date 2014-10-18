<?php    
 
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));
 
$url = $_GET['url'];

//echo 'url: '.dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.$url;

require_once (ROOT . DS . 'library' . DS . 'bootstrap.php');
