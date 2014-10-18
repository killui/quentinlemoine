<?php

class CreateModel extends Model{

    function __construct() {
        parent::__construct(); 
    }

    public function ProjectExist($use_id) {
        global $database;

        $query = $database->prepare('SELECT COUNT(project_id) as nbre
            FROM  project
            WHERE project.project_validate = 0
            AND project.user_user_id = :use_id');

        $query->bindParam(':use_id', $use_id);

        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
        return $data->nbre;
    }

    public function StartNew($use_id) {
        global $database;

        $query = $database->prepare('INSERT INTO project(project_validate, user_user_id)
                                            VALUES (0, :use_id)');

        $query->bindParam(':use_id', $use_id);

        $query->execute();
    }

    public function GetProjectData($use_id) {
        global $database;

        $query = $database->prepare('SELECT *
            FROM project
            WHERE project.project_validate = 0
            AND project.user_user_id = :use_id');

        $query->bindParam(':use_id', $use_id);

        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
        return $data;
    }

    public function GetUserData($use_id) {
        global $database;

        $query = $database->prepare('SELECT *
            FROM user
            WHERE user_id = :use_id');

        $query->bindParam(':use_id', $use_id);

        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
        return $data;
    }

    public function GetGenreData($proj_id)
    {
        global $database;

        $query = $database->prepare('SELECT *
            FROM genre_has_project, genre
            WHERE genre_has_project.project_project_id = :id
            AND genre_id = genre_genre_id');

        $query->bindParam(':id', $proj_id);

        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
        return $data;
    }

    public function GetCategories() {
        global $database;

        $query = $database->prepare('SELECT *
            FROM genre');

        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function GetPerks($proj_id) {
        global $database;

        $query = $database->prepare('SELECT *
            FROM perks
            WHERE project_project_id = :id
            ORDER BY perks_money ASC');

        $query->bindParam(':id', $proj_id);

        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

}