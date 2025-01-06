<?php
require_once 'Models/DetailEventModel.php';

$model = new DetailEventModel();

// Récupérer l'ID de l'événement
$idEvent = isset($_POST['idEvent']) ? intval($_POST['idEvent']) : null;

if (!$idEvent) {
    echo var_dump($_POST);
}

$event = $model->getEventById($idEvent);

if (!$event) {
    die("Événement introuvable dans la base de données.");
}

if (isset($_SESSION['id'])) {
    $userRole =  $_SESSION['role'];
    $userName = $_SESSION['nom'];
}

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

if (isset($_POST['inscription']) && $_POST['inscription'] == 1) {
    $idEvent = intval($_POST['idEvent']);
    if(!isset($_SESSION['id'])){
        header("Location: ?page=Login");
        exit();
    }
    $userId = $_SESSION['id'];
    
    $event = $model->getEventById($idEvent);
    if ($event['capaEvent'] > 0) {
        $model->inscription($idEvent, $userId);
        $message = "Réservation effectuée avec succès.";
    } else {
        $message = "Plus de place disponible.";
    }
    $detailAffiche .= '<p>' . htmlspecialchars($message) . '</p>';
}else {
    $detailAffiche .= '
    <form action="?page=DetailEvent" method="POST">
            <input name="inscription" type="hidden" value="1">
            <button class="inscrire" type="submit" name="idEvent" value='.$event['idEvent'].'>S\'inscrire</button>
    </form>';
}

if (isset($userRole) ? $userRole < 4 : false) {
    $detailAffiche .= "
        <form action='?page=UpdateEvent' method='post' >
        <input type='hidden' name='adminPanel' value='1'>
        <input type='hidden' name='idEvent' value='" . $event['idEvent'] . "' />
            <button type='submit' name='update' class='param'>Paramétrer</button>
        </form>";
}

$detailAffiche .= '</div>';


require 'Views/DetailEvent.php';
?>
