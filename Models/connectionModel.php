<?php
require 'DBModel.php';

class ConnectionModel extends DBModel {

    public function __construct(){
        parent::__construct();
    }

    public function login($username, $password) {
        $sql = "call login(:username)";
        $init = $this->db->prepare($sql);
        $init->bindParam(':username', $username);
        $init->execute();
        $result = $init->fetch()[0];
        return $return = password_verify($password, $result) ? True : False;
    }

    function changePwd($username, $password, $newPassword) {
        $sql = "call changePwd(\"$username\", \"$password\", \"$newPassword\")";
        $init = $this->db-> prepare($sql);
        $init -> execute();
        $result = $init->fetch()[0];
        return $result;
    }

    function createUser($nom, $prenom, $classe, $mail, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "CALL createUser(\"$nom\", \"$prenom\", \"$mail\", \"$hashedPassword\", \"$classe\")";
        $init = $this->db->prepare($sql);
        $init->execute();
        $result= $init->fetch()[0];
        if ($result == 1) {
            return "Utilisateur créee avec succès";
        } else {
            return $result;
        }
    }
}