<?php


require_once 'Models/CalendrierUserModel.php';

$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
$userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité';
$TP = isset($_POST['TP']) ? $_POST['TP'] : null;

if (!$TP) {
    die("Erreur : ID TP Agenda manquant ou invalide.");
}

$model = new CalendrierUserModel();
$events = $model->getEventsByTP($TP);

require 'Views/CalendrierUser.php';
?>