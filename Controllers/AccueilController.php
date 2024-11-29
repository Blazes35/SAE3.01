<?php
require_once 'Models/AccueilModel.php';
$model = new AccueilModel();
$actualites = $model->getAccueil();
require 'Views/Accueil.php';
?>