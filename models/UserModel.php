<?php

class UserModel extends Model {

    function __construct() {
        parent::__construct();
    }

    function loginCheck($email, $pwd)
    {
        global $database;

        $query = $database->prepare('SELECT * FROM user WHERE user_email = :email AND user_password = :mdp');

        $query->bindParam(':email', $email);
        $query->bindParam(':mdp', $pwd);
        
        $query->execute();
        $infocompte = $query->fetch(PDO::FETCH_OBJ);    
        return $infocompte;
    }

    function verifUser($email) {
        global $database;

        $query = $database->prepare('SELECT COUNT(user_email) as id
                                     FROM user WHERE user_email = :email');

        $query->bindParam(':email', $email);
          
        $query->execute();
        $data = $query->fetch(PDO::FETCH_OBJ);
        return $data->id;
    }
    
    public function userInsert($name, $surname, $mail, $mdp) {
        global $database;

        $query = $database->prepare('INSERT INTO user (user_name, user_surname, user_email, user_password)
		values("'.$name.'", "'.$surname.'", "'.$mail.'", "'.$mdp.'")');

        $userinsert = $query->execute();
        return $userinsert;
    }
    
    public function getAll(){
        global $database;

        $query = $database->prepare('SELECT * FROM user');
        
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    
    public function getUSer($id){
        global $database;

        $query = $database->prepare('SELECT * FROM user WHERE user_id = :id');
        
        $query->bindParam(':id', $id);
        
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }

}