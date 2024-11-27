<?php
require_once 'Models/UpdateEventModel.php';
$model = new UpdateEventModel();
$updateEventAff = ''; 
$message = '';  
$event = null;  

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $idEvent = intval($_POST['idEvent']);


    if ($action === 'update') {
        $nomEvent = $_POST['titre'];
        $descEvent = $_POST['desc'];
        $prixEvent = floatval($_POST['price']);
        $capaEvent = intval($_POST['capacite']);
        $minRole = intval($_POST['minRole']);
        $minGrade = intval($_POST['minGrade']);
        $imgEvent = $_POST['currentImg'];

        if ($minRole < 0 || $minRole > 4) {
            $message = "Le min rôle doit être compris entre 0 et 4.";
        } elseif ($minGrade < 0 || $minGrade > 4) {
            $message = "Le min grade doit être compris entre 0 et 4.";
        } else {
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/evenements/';
                $fileName = basename($_FILES['img']['name']);
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                    $imgEvent = $fileName;
                } else {
                    $message = "Erreur lors de l'upload de l'image.";
                }
            }

            if ($model->updateEvent($idEvent, $nomEvent, $descEvent, $prixEvent, $capaEvent, $imgEvent, $minRole, $minGrade)) {
                $message = "Événement mis à jour avec succès !";
            } else {
                $message = "Erreur lors de la mise à jour de l'événement.";
            }
        }
    }

    // Si l'action est "delete", on supprime l'événement
    if ($action === 'delete') {
        if ($model->deleteEvent($idEvent)) {
            $message = "Événement supprimé avec succès !";
            header("Location: events_list.php"); 
            exit;
        } else {
            $message = "Erreur lors de la suppression de l'événement.";
        }
    }
}

if (isset($_GET['id'])) {
    $idEvent = intval($_GET['id']);
    $event = $model->getEventById($idEvent);  
    if (!$event) {
        $message = "L'événement n'a pas été trouvé.";
    }
}

include 'Views/UpdateEvent.php';
?>
