<?php

require_once 'DBModel.php';
// EventModel.php
class updateEventModel extends DBModel {

    public function __construct() {
        parent::__construct();
    }

    // Récupérer un événement par son ID
    public function getEvent($idEvent) {
        $stmt = self::$db->prepare('SELECT * FROM EVENEMENT WHERE idEvent = :idEvent');
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    public function updateEvent($idEvent, $titreEvent, $descEvent, $prixEvent, $capaEvent, $imgEvent,
    $minRoleEvent, $minGradeEvent) {
        $stmt = self::$db->prepare('
            UPDATE evenement 
            SET titreEvent = :titreEvent, 
                descEvent = :descEvent, 
                prixEvent = :prixEvent, 
                capaEvent = :capaEvent, 
                imgEvent = :imgEvent, 
                minRoleEvent = :minRole, 
                minGradeEvent = :minGrade
            WHERE idEvent = :idEvent
        ');

        $stmt->bindParam(':titreEvent', $data['titre']);
        $stmt->bindParam(':descEvent', $data['desc']);
        $stmt->bindParam(':prixEvent', $data['price']);
        $stmt->bindParam(':capaEvent', $data['capacite']);
        $stmt->bindParam(':imgEvent', $data['img']);
        $stmt->bindParam(':minRole', $data['minRole']);
        $stmt->bindParam(':minGrade', $data['minGrade']);
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deleteEvent($idEvent) {
        $stmt = self::$db->prepare("DELETE FROM evenement WHERE idEvent = :idEvent");
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        return $stmt->execute();
        return "Evenement supprimé avec succès";
    }
}
?>
