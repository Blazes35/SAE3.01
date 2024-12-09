<?php
require_once 'Models/DetailEventModel.php';

$model = new DetailEventModel();

// Récupérer l'ID de l'événement
$idEvent = isset($_POST['idEvent']) ? intval($_POST['idEvent']) : null;

if (!$idEvent) {
    echo var_dump($_POST);
    // die("Aucun événement trouvé ou aucun ID fourni."$_POST);
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
            <img src="' . htmlspecialchars('uploads/evenement/' . $event['imgEvent']) . '" alt="' . htmlspecialchars($event['titreEvent']) . '">
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
    $detailAffiche .= '
    <form action="?page=DetailEvent" method="POST">
            <input name="inscription" type="hidden" value="1">
            <button class="inscrire" type="submit" name="idEvent" value='.$event['idEvent'].'>S\'inscrire</button>
    </form>';

    if ($userRole < 4) {
        $detailAffiche .= "
            <form action='?page=detailEvent' method='post' >
            <input type='hidden' name='adminPanel' value='1'>
            <input type='hidden' name='idEvent' value='" . $event['idEvent'] . "' />
                <button type='submit' name='update' class='param'>Paramétrer</button>
            </form>";
    }
    $detailAffiche .= '</div>';

if (isset($_POST['inscription'])) {
    $model->inscription($idEvent, $_SESSION['id']);
    $detailAffiche .= '<p class="inscription">Inscription réussie !</p>';
}

require 'Views/DetailEvent.php';
?>
