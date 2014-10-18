<?php

class Model {

    function __construct() {
        try {
            global $database;
            require_once 'library/config.php';
            //config de la base de données
            $dbtype = 'mysql';
            $dbhost = DB_HOST;
            $dbname = DB_NAME;
            $dbuser = DB_USER;
            $dbpass = DB_PASS;

            $dns = $dbtype . ':host=' . $dbhost . ';dbname=' . $dbname;

            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

            $database = new PDO($dns, $dbuser, $dbpass, $options);
            
            return $database; 
            
        } catch (Exception $e) {
            echo "connection à mysql impossible : " . $e->getMessage();
            die();
        }
    }
}