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
}
?>