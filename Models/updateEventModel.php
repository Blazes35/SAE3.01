<?php 
require_once 'DBModel.php';
class updateEventModel extends DBModel{
    public function __construct(){
        parent::__construct();
    }

    public function getEventById($id) {
        $stmt = self::$db->prepare("SELECT * FROM evenement WHERE idEvent = :idEvent");
        $stmt->bindParam(':idEvent', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateEvent($data) {
        $query = "
            UPDATE evenement 
            SET titreEvent = :titreEvent, descEvent = :descEvent, prixEvent = :prixEvent, 
                capaEvent = :capaEvent, imgEvent = :imgEvent, minRoleEvent = :minRole, 
                minGradeEvent = :minGrade
            WHERE idEvent = :idEvent
        ";
        $stmt = self::$db->prepare($query);
        return $stmt->execute($data);
    }

    public function deleteEvent($id) {
        $stmt = self::$db->prepare("DELETE FROM evenement WHERE idEvent = :idEvent");
        $stmt->bindParam(':idEvent', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>