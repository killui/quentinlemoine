<?php

class bootstrap {
    
    function __construct() {
        
        if (isset($_GET['url'])) {
            $page = $_GET['url'];
            $url = explode('/', rtrim($_GET['url'], '/'));
            //print_r($url);
            
            $file = "controllers/".$url[0].".php";

            if (file_exists($file)){
                require $file;
                $controller = new $url[0]($this, $url, $page);
            } else {
                $controller = new error($this, $url, $page);
            }
            
            
        } else {
            $controller = new index;
        }
    }

}