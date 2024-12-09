<?php
require_once 'DBModel.php';

class DetailEventModel extends DBModel {

    public function __construct(){
        parent::__construct();
    }

    public function getEventById($idEvent) {
        $stmt = self::$db->prepare("SELECT * FROM EVENEMENT WHERE idEvent = :id");
        $stmt -> bindParam(':id', $idEvent, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function inscription($idEvent, $idUser) {
        $smt = self::$db->prepare("SELECT * FROM RESERVATION WHERE idEvent = :idEvent AND idUser = :idUser");
        $smt -> bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        $smt -> bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $smt->execute();
        if ($smt->fetch(PDO::FETCH_ASSOC)) {
            return;
        }
        $stmt = self::$db->prepare("INSERT INTO RESERVATION (idEvent, idUser) VALUES (:idEvent, :idUser)");
        $stmt -> bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        $stmt -> bindParam(':idUser', $idUser, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>