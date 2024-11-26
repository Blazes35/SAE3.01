<?php
require 'DBModel.php';

class ConnectionModel extends DBModel {

    public function __construct(){
        parent::__construct();
    }

    public function login($username, $password) {
        $hashedPassword = hash('sha256', $password);
        $sql = "call login(:username, :password)";
        $init = self::$db->prepare($sql);
        $init->bindParam(':username', $username);
        $init->bindParam(':password', $hashedPassword);

        $init->execute();
        $result = $init->fetch(PDO::FETCH_ASSOC);

        // $_SESSION['result'] = json_encode($result);

        if ($result["Failed"] == 1) {
            return False;
        } else {
            $_SESSION['nom'] = $result['nomUser'];
            $_SESSION['prenom'] = $result['prenomUser'];
            $_SESSION['email'] = $result['adrMailUser'];
            $_SESSION['TP'] = $result['idTPAgenda'];
            $_SESSION['pp'] = $result['ppUser'];
            $_SESSION['role'] = $result['idRole'];
            $_SESSION['grade'] = $result['idGrade'];
            return True;
        }
    }

    function changePwd($email, $oldPassword, $newPassword) {
        $sql = "call changePwd(\"$email\", \"$oldPassword\", \"$newPassword\")";
        $init = self::$db-> prepare($sql);
        $init -> execute();
        return $init->fetch()[0] == 1 ? True : False;
    }

    function createUser($nom, $prenom, $classe, $mail, $password) {
        $hashedPassword = hash('sha256', $password);
        $sql = "CALL createUser(\"$nom\", \"$prenom\", \"$classe\", \"$mail\", \"$hashedPassword\")";
        $init = self::$db->prepare($sql);
        $init->execute();
        $result= $init->fetch()[0];
        return $result == 1 ? True : False;
    }
}