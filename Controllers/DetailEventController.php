<?php
require_once 'Models/DetailEventModel.php';

$model = new DetailEventModel();

// Récupérer l'ID de l'événement
$idEvent = isset($_POST['idEvent']) ? intval($_POST['idEvent']) : null;

if (!$idEvent) {
    die("Aucun événement trouvé ou aucun ID fourni.");
}

// Charger les détails de l'événement
$event = $model->getEventById($idEvent);

if (!$event) {
    die("Événement introuvable dans la base de données.");
}

// Récupérer les informations de l'utilisateur
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
$userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité';

// Affichage des détails de l'événement
$detailAffiche = '';
$detailAffiche .= '<div class="image-gallery">
        <div class="first-img">
            <img src="' . htmlspecialchars('uploads/evenements/' . $event['imgEvent']) . '" alt="' . htmlspecialchars($event['titreEvent']) . '">
        </div>
    </div>
    <div class="event-details">
        <h1 class="event-title">' . htmlspecialchars($event['titreEvent']) . '</h1>
        <p class="description">' . htmlspecialchars($event['descEvent']) . '</p>
        <p class="capacite">Capacité : ' . htmlspecialchars($event['capaEvent']) . '</p>
        <p class="lieu">Lieu : ' . htmlspecialchars($event['lieuEvent']) . '</p>
        <p class="date">Date : ' . htmlspecialchars($event['dateEvent']) . '</p>
        <p class="price">' . htmlspecialchars($event['prixEvent']) . ' €</p>
    </div>
    <div class="boutons">';

    if ($userRole < 4) {
        $detailAffiche .= "
            <form action='/?page=UpdateEvent' method='post' >
            <input type='hidden' name='adminPanel' value='1'>
            <input type='hidden' name='idEvent' value='" . $event['idEvent'] . "' />
                <button type='submit' name='update' class='param'>Paramétrer</button>
            </form>";
    }
$detailAffiche .= '<a href="inscription.php?idEvent=' . urlencode($event['idEvent']) . '"><button class="inscrire">S\'inscrire</button></a>
    </div>';

require 'Views/DetailEvent.php';
?>
