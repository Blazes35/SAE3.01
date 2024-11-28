<?php 
require_once 'Models/updateEventModel.php';

class updateEventController {
    private $model;

    public function __construct() {
        $db = getDatabaseConnection();
        $this->model = new Event($db);
    }

    public function editEvent($id) {
        $event = $this->model->getEventById($id);
        if (!$event) {
            echo "Événement introuvable.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'];
            if ($action === 'update') {
                $data = [
                    ':titreEvent' => $_POST['titre'],
                    ':descEvent' => $_POST['desc'],
                    ':prixEvent' => $_POST['price'],
                    ':capaEvent' => $_POST['capacite'],
                    ':imgEvent' => $_POST['currentImg'],
                    ':minRole' => $_POST['minRole'],
                    ':minGrade' => $_POST['minGrade'],
                    ':idEvent' => $id
                ];

                // Gestion de l'upload
                if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = 'uploads/evenements/';
                    $fileName = basename($_FILES['img']['name']);
                    $uploadFile = $uploadDir . $fileName;

                    if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                        $data[':imgEvent'] = $fileName;
                    }
                }

                $this->model->updateEvent($data);
                header('Location: index.php');
            } elseif ($action === 'delete') {
                $this->model->deleteEvent($id);
                header('Location: index.php');
            }
        }

        require __DIR__ . '/../views/event/edit.php';
    }
}

?>