<?php
require_once 'DBModel.php';

class DetailEventModel extends DBModel {

    public function __construct(){
        parent::__construct();
    }

    public function getEventById($idEvent) {
        $query = self::$db->prepare("SELECT * FROM EVENEMENT WHERE idEvent = :id");
        $query->execute(['id' => $idEvent]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
?>