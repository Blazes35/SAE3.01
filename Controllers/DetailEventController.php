<?php
require_once 'Models/DetailEventModel.php';

session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();

$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
$userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité';

$idEvent = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!$idEvent) {
    die("Erreur : ID d'événement manquant ou invalide.");
}

$model = new DetailEventModel();
$event = $model->getEventById($idEvent);

if (!$event) {
    die("Erreur : Événement introuvable.");
}

require 'Views/DetailEvent.php';
?>