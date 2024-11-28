<?php
require_once 'Models/UpdateEventModel.php';

// Créer une instance du modèle
$model = new UpdateEventModel();
$message = '';
$event = null;
$formHtml = '';

// Si une action est en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mise à jour de l'événement
    if (isset($_POST['updateEvent']) && isset($_POST['idEvent'])) {
        $idEvent = intval($_POST['idEvent']);
        $nomEvent = $_POST['titre'] ?? null;
        $descEvent = $_POST['desc'] ?? null;
        $prixEvent = isset($_POST['price']) ? floatval($_POST['price']) : null;
        $capaEvent = isset($_POST['capacite']) ? intval($_POST['capacite']) : null;
        $minRole = isset($_POST['minRole']) ? intval($_POST['minRole']) : null;
        $minGrade = isset($_POST['minGrade']) ? intval($_POST['minGrade']) : null;
        $imgEvent = $_POST['currentImg'] ?? null;

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
        if (!$message && $nomEvent && $descEvent && $prixEvent !== null && $capaEvent !== null && $minRole !== null && $minGrade !== null) {
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
if (isset($_GET['id'])) {
    $idEvent = intval($_GET['id']);
    $event = $model->getEvent($idEvent);
}

// Génération du formulaire HTML si l'événement existe
if ($event) {
    $formHtml = '<div class="formulaire">
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="idEvent" value="' . htmlspecialchars($event['idEvent']) . '" />
        <input type="hidden" name="currentImg" value="' . htmlspecialchars($event['imgEvent']) . '" />
        <div>
            <label for="titre">Nom de l\'événement</label>
            <input type="text" id="titre" name="titre" value="' . htmlspecialchars($event['titreEvent']) . '" required />
        </div>
        <br>
        <div>
            <label for="desc">Description</label>
            <input type="text" id="desc" name="desc" value="' . htmlspecialchars($event['descEvent']) . '" />
        </div>
        <br>
        <div>
            <label for="price">Prix</label>
            <input type="number" step="0.01" id="price" name="price" value="' . htmlspecialchars($event['prixEvent']) . '" required />
        </div>
        <br>
        <div>
            <label for="capacite">Capacité</label>
            <input type="number" id="capacite" name="capacite" value="' . htmlspecialchars($event['capaEvent']) . '" required />
        </div>
        <br>
        <div>
            <label for="minRole">Min rôle</label>
            <input type="number" id="minRole" name="minRole" value="' . htmlspecialchars($event['minRoleEvent']) . '" required min="0" max="4" />
        </div>
        <br>
        <div>
            <label for="minGrade">Min grade</label>
            <input type="number" id="minGrade" name="minGrade" value="' . htmlspecialchars($event['minGradeEvent']) . '" required min="0" max="4" />
        </div>
        <br>
        <div>
            <label for="img">Image</label>
            <input type="file" id="img" name="img" accept="image/*" />
            <p>Image actuelle : <strong>' . htmlspecialchars($event['imgEvent']) . '</strong></p>
            <img src="uploads/evenements/' . htmlspecialchars($event['imgEvent']) . '" alt="Image actuelle" style="max-width: 200px; height: auto;" />
        </div>
        <br>
        <button type="submit" name="updateEvent">Mettre à jour</button>
    </form>
    <br>
    <form method="POST" action="">
        <input type="hidden" name="idEvent" value="' . htmlspecialchars($event['idEvent']) . '" />
        <button type="submit" name="action" value="delete" style="background-color: red; color: white;">Supprimer l\'événement</button>
    </form>
    </div>';
    
} else {
    $formHtml = "<p>Aucun événement trouvé ou aucun ID fourni.</p>";
}

// Inclure la vue
include 'Views/UpdateEvent.php';
?>
