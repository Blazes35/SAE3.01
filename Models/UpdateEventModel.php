<?php
require_once 'DBModel.php';
class EventModel extends DBModel {
 

    public function __construct($dbConnection) {
        parent::__construct();    
    }

    public function updateEvent($idEvent, $nomEvent, $descEvent, $minRole, $minGrade, $prixEvent, $capaEvent, $imgEvent) {
        $updateQuery = "
            UPDATE evenement 
            SET titreEvent = :titreEvent, descEvent = :descEvent, prixEvent = :prixEvent, 
                capaEvent = :capaEvent, imgEvent = :imgEvent, minRoleEvent = :minRole, 
                minGradeEvent = :minGrade
            WHERE idEvent = :idEvent
        ";
        $stmt = $this->connect->prepare($updateQuery);

        $stmt->bindParam(':titreEvent', $nomEvent, PDO::PARAM_STR);
        $stmt->bindParam(':descEvent', $descEvent, PDO::PARAM_STR);
        $stmt->bindParam(':prixEvent', $prixEvent, PDO::PARAM_STR);
        $stmt->bindParam(':capaEvent', $capaEvent, PDO::PARAM_INT);
        $stmt->bindParam(':imgEvent', $imgEvent, PDO::PARAM_STR);
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        $stmt->bindParam(':minRole', $minRole, PDO::PARAM_INT);
        $stmt->bindParam(':minGrade', $minGrade, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur SQL : " . $e->getMessage());
        }
    }

    public function deleteEvent($idEvent) {
        $deleteQuery = "DELETE FROM evenement WHERE idEvent = :idEvent";
        $stmt = $this->connect->prepare($deleteQuery);
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur SQL : " . $e->getMessage());
        }
    }

    public function getEventById($idEvent) {
        $selectQuery = "SELECT * FROM evenement WHERE idEvent = :idEvent";
        $stmt = $this->connect->prepare($selectQuery);
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur SQL : " . $e->getMessage());
        }
    }
}

?>