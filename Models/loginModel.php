<?php
require 'connectionModel.php';

class LoginModel extends ConnectionModel {

    public function __construct(){
        parent::__construct();
    }

    public function login($username, $password) {
        $sql = "call login(:username)";
        $init = $this->db->prepare($sql);
        $init->bindParam(':username', $username);
        $init->execute();
        $result = $init->fetch()[0];
        if ($result == -1) {
            $return = "Erreur email ou mot de passe incorrect";
        } else {
            $return = password_verify($password, $result) ? "Connexion réussie" : "Erreur email ou mot de passe incorrect";
        }
        return $return;
    }
}