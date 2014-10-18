<?php

class CrawdModel extends Model{

    function __construct() {
        parent::__construct();
        
    }
    
    public function crawdInsert($sum, $user, $project) {
        global $database;

        $query = $database->prepare('INSERT INTO crawd (crawd_sum, user_user_id, project_project_id) 
            VALUES (:sum, :user, :project)');

        $query->bindParam(':sum', $sum);
        $query->bindParam(':user', $user);
        $query->bindParam(':project', $project);

        $userinsert = $query->execute();
        return $userinsert;
    }

}