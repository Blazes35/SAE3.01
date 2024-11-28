<?php
require_once 'Models/updateEventModel.php';

class updateEventController {
    private $eventModel;

    public function __construct() {
        $this->eventModel = new Event();
    }

    // Récupérer l'événement
    public function getEvent($idEvent) {
        return $this->eventModel->getEventById($idEvent);
    }

    // Mettre à jour l'événement
    public function updateEvent($idEvent, $data) {
        return $this->eventModel->updateEvent($idEvent, $data);
    }

    // Supprimer un événement
    public function deleteEvent($idEvent) {
        return $this->eventModel->deleteEvent($idEvent);
    }
}
?>
