<?php
require_once 'DBModel.php';

class updateEventModel extends DBModel {
    private $db;

    public function __construct() {
        $dbModel = new DBModel();
        $this->db = $dbModel->getDB();  // Utilisation de la connexion de DBModel
    }

    // Récupérer un événement par son ID
    public function getEventById($idEvent) {
        $stmt = $this->db->prepare("SELECT * FROM EVENEMENT WHERE idEvent = :idEvent");
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Mettre à jour les informations de l'événement
    public function updateEvent($idEvent, $data) {
        $stmt = $this->db->prepare("UPDATE EVENEMENT SET 
            titreEvent = :titreEvent, 
            descEvent = :descEvent, 
            prixEvent = :prixEvent, 
            capaEvent = :capaEvent, 
            minRoleEvent = :minRoleEvent, 
            minGradeEvent = :minGradeEvent, 
            imgEvent = :imgEvent 
            WHERE idEvent = :idEvent");

        $stmt->bindParam(':titreEvent', $data['titre']);
        $stmt->bindParam(':descEvent', $data['desc']);
        $stmt->bindParam(':prixEvent', $data['price']);
        $stmt->bindParam(':capaEvent', $data['capacite']);
        $stmt->bindParam(':minRoleEvent', $data['minRole']);
        $stmt->bindParam(':minGradeEvent', $data['minGrade']);
        $stmt->bindParam(':imgEvent', $data['img']);
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Supprimer un événement
    public function deleteEvent($idEvent) {
        $stmt = $this->db->prepare("DELETE FROM EVENEMENT WHERE idEvent = :idEvent");
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
