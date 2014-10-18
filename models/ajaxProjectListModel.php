<?php

class ajaxProjectListModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function getProjects($tags_filter, $city_filter) {
        global $database;

        $query = $database->prepare('SELECT * 
            FROM  project, region, user, genre, genre_has_project
            WHERE region_id = region_region_id
            AND user.user_id = project.user_user_id

            AND project.project_validate = 1

            '.$tags_filter.'
            '.$city_filter.'
            GROUP BY project.project_id
            ORDER BY project.project_creation_date DESC');

        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function getAllTags() {
        global $database;

        $query = $database->prepare('SELECT * 
            FROM  genre
            ORDER BY genre.genre_name ASC');

        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function getRessourceshave($id) {
        global $database;

        $query = $database->prepare('SELECT COUNT(ressource_have_accept) as nbre
            FROM  ressource_have, project
            WHERE ressource_have_accept = 1
            AND ressource_have.project_project_id = project.project_id
            AND project.project_id = :id');

        $query->bindParam(':id', $id);

        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
        return $data->nbre;
    }

    public function getFunding($id) {
        global $database;

        $query = $database->prepare('SELECT SUM(crawd_sum) as TotFund
            FROM  crawd, project
            WHERE crawd.project_project_id = project.project_id
            AND project.project_id = :id');

        $query->bindParam(':id', $id);

        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
        return $data->TotFund;
    }

    //REQUETES POUR LA PAGE PROJET

    public function getProject($id) {
        global $database;

        $query = $database->prepare('SELECT * 
            FROM  project, region, user
            WHERE project_id = :id
            AND region_id = region_region_id
            AND user.user_id = project.user_user_id');

        $query->bindParam(':id', $id);

        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
        return $data;
    }

    public function getGenres($id) {
        global $database;

        $query = $database->prepare('SELECT genre_name 
            FROM  project, genre, genre_has_project
            WHERE genre.genre_id = genre_has_project.genre_genre_id 
            AND project.project_id = genre_has_project.project_project_id');

        $query->bindParam(':id', $id);

        $query->execute();
        $genres = $query->fetch(PDO::FETCH_OBJ);
        return $genres;
    }

    public function getPerks($id) {
        global $database;

        $query = $database->prepare('SELECT perks_money, perks_reward 
            FROM  project, perks
            WHERE project_id = :id
            AND project_id = project_project_id');

        $query->bindParam(':id', $id);

        $query->execute();
        $perks = $query->fetchAll();
        return $perks;
    }

    public function getRessources($id) {
        global $database;

        $query = $database->prepare('SELECT ressource_name, ressource_need_number 
            FROM  ressource, ressource_need, project
            WHERE project_id = :id
            AND project_id = project_project_id
            AND ressource_need.ressource_ressource_id = ressource.ressource_id');

        $query->bindParam(':id', $id);

        $query->execute();
        $ressources = $query->fetchAll();
        return $ressources;
    }

    public function displayTime($deadline) {
        $today = time();
        $date = $deadline;
        $dif = $date - $today;
        if ($dif < 0) {
            return 'Finished';
        }
        if (($dif > 0) && ($dif < 60)) {
            return $dif . ' Seconds left';
        }
        if (($dif > 60) && ($dif < 3600)) {
            $dif_min = round($dif / 60);
            return $dif_min . ' Minutes left';
        }
        if (($dif > 3600) && ($dif < 86400)) {
            $dif_heu = round($dif / 60 / 60);
            return $dif_heu . ' Hours left';
        }
        if ($dif > 86400) {
            $dif_jour = round($dif / 60 / 60 / 24);
            return $dif_jour . ' Days left';
        }
    }

}