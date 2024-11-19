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
        return $return = password_verify($password, $result) ? True : False;
    }
}