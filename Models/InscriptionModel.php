   <?php

//InscriptionModel.php
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

    public function reserveEvent($idEvent, $idUser) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("SELECT capaEvent FROM EVENEMENT WHERE idEvent = :idEvent FOR UPDATE");
            $stmt->execute(['idEvent' => $idEvent]);
            $event = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$event || $event['capaEvent'] <= 0) {
                $this->db->rollBack();
                return ["success" => false, "message" => "Plus de place disponible pour cet événement."];
            }

            $stmt = $this->db->prepare("INSERT INTO RESERVATION (idEvent, idUser) VALUES (:idEvent, :idUser)");
            $stmt->execute(['idEvent' => $idEvent, 'idUser' => $idUser]);

            $stmt = $this->db->prepare("UPDATE EVENEMENT SET capaEvent = capaEvent - 1 WHERE idEvent = :idEvent");
            $stmt->execute(['idEvent' => $idEvent]);

            $this->db->commit();
            return ["success" => true, "message" => "Réservation réussie."];
        } catch (Exception $e) {
            $this->db->rollBack();
            return ["success" => false, "message" => "Erreur lors de la réservation : " . $e->getMessage()];
        }
    }
}

?>