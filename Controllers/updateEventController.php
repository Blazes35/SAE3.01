<?php
require_once 'Models/UpdateEventModel.php';

// Créer une instance du modèle
$model = new UpdateEventModel();
$message = '';
$event = null;

// $formHtml = '';

// Si une action est en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mise à jour de l'événement
    if (isset($_POST['updateEvent'])) {
        $idEvent = intval($_POST['idEvent']);
        $nomEvent = $_POST['titre'] ?? 'null';
        $descEvent = $_POST['desc'] ?? 'null';
        $prixEvent = isset($_POST['price']) ? floatval($_POST['price']) : 'null';
        $capaEvent = isset($_POST['capacite']) ? intval($_POST['capacite']) : 'null';
        $minRole = isset($_POST['minRole']) ? intval($_POST['minRole']) : 'null';
        $minGrade = isset($_POST['minGrade']) ? intval($_POST['minGrade']) : 'null';
        $imgEvent = $_POST['currentImg'] ?? 'null';

        // Gestion de l'upload d'image
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/evenements/';
            $fileName = basename($_FILES['img']['name']);
            $uploadFile = $uploadDir . $fileName;

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['img']['type'], $allowedTypes)) {
                if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                    $imgEvent = $fileName;
                } else {
                    $message = "Erreur lors de l'upload de l'image.";
                }
            } else {
                $message = "Seuls les fichiers image sont autorisés.";
            }
        }

        // Mise à jour de l'événement
        if ($nomEvent !== null && $descEvent !== null && $prixEvent !== null && $capaEvent !== null && $minRole !== null && $minGrade !== null) {
            $message = $model->updateEvent($idEvent, $nomEvent, $descEvent, $prixEvent, $capaEvent, $imgEvent, $minRole, $minGrade);
        } else {
            $message = "Tous les champs obligatoires ne sont pas remplis.";
        }
    }

    // Suppression de l'événement
    if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['idEvent'])) {
        $idEvent = intval($_POST['idEvent']);
        $message = $model->deleteEvent($idEvent);
    }
}

// Chargement des données de l'événement
if (isset($_POST['id'])) {
    $idEvent = intval($_POST['id']);
    $event = $model->getEvent($idEvent);
}


// Inclure la vue
include 'Views/UpdateEvent.php';
?>
