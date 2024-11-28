<?php

require_once 'DBModel.php';
// EventModel.php
class updateEventModel extends DBModel {

    public function __construct() {
        parent::__construct();
    }

    public function getEvent($id) {
        $selectQuery = "SELECT * FROM evenement WHERE idEvent = :idEvent";
        $stmt = self::$db->prepare($selectQuery);
        $stmt->bindParam(':idEvent', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEvent($idEvent, $nomEvent, $descEvent, $minRole, $minGrade, $prixEvent, $capaEvent, $imgEvent) {
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $result = self::updateImage();
            if ($result) {
                $imgEvent = $result;
            } else {
                return false;
            }
        }
        // Mise à jour de l'événement
        $updateQuery = "
            UPDATE evenement 
            SET titreEvent = :titreEvent, descEvent = :descEvent, prixEvent = :prixEvent, 
                capaEvent = :capaEvent, imgEvent = :imgEvent, minRoleEvent = :minRole, 
                minGradeEvent = :minGrade
            WHERE idEvent = :idEvent";
        $stmt = self::$db->prepare($updateQuery);
        $stmt->bindParam(':titreEvent', $nomEvent, PDO::PARAM_STR);
        $stmt->bindParam(':descEvent', $descEvent, PDO::PARAM_STR);
        $stmt->bindParam(':prixEvent', $prixEvent, PDO::PARAM_STR);
        $stmt->bindParam(':capaEvent', $capaEvent, PDO::PARAM_INT);
        $stmt->bindParam(':imgEvent', $imgEvent, PDO::PARAM_STR);
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        $stmt->bindParam(':minRole', $minRole, PDO::PARAM_INT);
        $stmt->bindParam(':minGrade', $minGrade, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateImage(){
        $uploadDir = 'uploads/evenements/';
        $fileName = basename($_FILES['img']['name']);
        $uploadFile = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
            return $fileName;
        } else {
            return false;
        }
    }

    public function deleteEvent($id){
        $deleteQuery = "DELETE FROM evenement WHERE idEvent = :idEvent";
        $stmt = self::$db->prepare($deleteQuery);
        $stmt->bindParam(':idEvent', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
