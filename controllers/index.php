<?php

class index extends Controller {

    function __construct() {
        parent::__construct();

        $page = "index";

        $title = "index";

        $this->View->render('index', $title, $page);


    }

}