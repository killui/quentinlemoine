<?php

class SaveModel extends Model {

    function __construct() {
        parent::__construct();
    }

    public function SaveUserDatas($name, $surname, $birthday, $bio)
    {
        global $database;

        $query = $database->prepare('UPDATE user SET 
            user_name = :name,
            user_surname = :surname,
            user_birthday = :birthday,
            user_biography = :bio
            WHERE user_id = :id');

        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':surname', $surname, PDO::PARAM_STR);
        $query->bindParam(':birthday', $birthday, PDO::PARAM_STR);
        $query->bindParam(':bio', $bio, PDO::PARAM_STR);
        $query->bindParam(':id', $_SESSION["user_id"]);

        $query->execute();
    }

    public function SaveProjDatas($proj_id, $title, $descr, $goal, $deadline, $about, $story) {
        global $database;

        $query = $database->prepare('UPDATE project SET 
            project_name = :title,
            project_text = :descr,
            project_target = :goal,
            project_deadline = :deadline,
            project_about = :about,
            project_storyline = :storyline
            WHERE project_id = :id');

        $query->bindParam(':title', $title, PDO::PARAM_STR);
        $query->bindParam(':descr', $descr, PDO::PARAM_STR);
        $query->bindParam(':goal', $goal);
        $query->bindParam(':deadline', $deadline, PDO::PARAM_STR);
        $query->bindParam(':about', $about, PDO::PARAM_STR);
        $query->bindParam(':storyline', $story, PDO::PARAM_STR);
        $query->bindParam(':id', $proj_id);

        $query->execute();
    }

    public function SaveGenreDatas($proj_id, $genre_id) {
        global $database;

        /// Suppr d'un éventuel ID
        /// A voir si une requête intelligente UPDATE OR INSERT est jouable
        $clean = $database->prepare('DELETE from genre_has_project
            WHERE project_project_id = :id');
        $clean->bindParam(':id', $proj_id);
        $clean->execute();

        $query = $database->prepare('INSERT into genre_has_project 
            (genre_genre_id, project_project_id)
            VALUES (:genre_id, :proj_id)');

        $query->bindParam(':genre_id', $genre_id);
        $query->bindParam(':proj_id', $proj_id);

        $query->execute();
    }

    public function CleanPerksDatas($proj_id) {
        global $database;

        $clean = $database->prepare('DELETE from perks
            WHERE project_project_id = :id');
        $clean->bindParam(':id', $proj_id);
        $clean->execute();
    }

    public function SavePerksDatas($amount, $descr, $proj_id) {
        global $database;

        $query = $database->prepare('INSERT into perks 
            (perks_money, perks_reward, project_project_id)
            VALUES (:amt, :descr, :proj_id)');

        $query->bindParam(':amt', $amount);
        $query->bindParam(':descr', $descr, PDO::PARAM_STR);
        $query->bindParam(':proj_id', $proj_id);

        $query->execute();
    }

}