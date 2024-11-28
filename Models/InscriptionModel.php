<?php
require_once 'DBModel.php';

class InscriptionModel extends DBModel {

    public function __construct(){
        parent::__construct();
    }

    public function getUserByEmail($email) {
        $query = self::$db->prepare("SELECT idUser FROM UTILISATEUR WHERE adrMailUser = :email");
        $query->execute(['email' => $email]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function checkReservation($idEvent, $idUser) {
        $query = self::$db->prepare("SELECT * FROM RESERVATION WHERE idEvent = :idEvent AND idUser = :idUser");
        $query->execute(['idEvent' => $idEvent, 'idUser' => $idUser]);
        return $query->rowCount() > 0;
    }

    public function addReservation($idEvent, $idUser) {
        $stmt = self::$db->prepare("INSERT INTO RESERVATION (idEvent, idUser) VALUES (:idEvent, :idUser)");
        $stmt->execute(['idEvent' => $idEvent, 'idUser' => $idUser]);
    }
}
?>