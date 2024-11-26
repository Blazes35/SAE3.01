<?php

    // Récupération des photos
$directory = 'uploads/galerie/';
$images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
require 'Views/Galerie.php';
?>