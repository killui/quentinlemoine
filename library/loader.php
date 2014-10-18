<?php
define('WEBROOT',  str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('ROOT',  str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));

function autoloadLibrary ($class) {
    $filename = "library/".$class.".php";
    if(is_readable($filename)) {
        require $filename;
    }
}

function autoloadModel ($class) {
    $filename = "models/".str_replace('_', DIRECTORY_SEPARATOR, $class).".php";
    if(is_readable($filename)) {
        require $filename;
    }
}
function autoloadController($class) {
    $filename = "controllers/".str_replace('_', DIRECTORY_SEPARATOR, $class).".php";
    if(is_readable($filename)) {
        require $filename;
    }
}
spl_autoload_register ('autoloadLibrary');
spl_autoload_register ('autoloadController');
spl_autoload_register ('autoloadModel');