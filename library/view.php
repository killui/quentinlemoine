<?php

class View {

    function __construct() {
        
    }
    
    public function render($view, $title, $page, $projects, $more_projects){
        require 'views/header.php';
        require 'views/'.$view.'.php';
        require 'views/footer.php';
    }
    
    
}


