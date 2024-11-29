<?php

    // Récupération des photos
$directory = 'uploads/galerie/';
$images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
$afficheImage='';
foreach ($images as $image){
    $afficheImage .= '<div class="gallery-item">
        <img src="'. htmlspecialchars($image) .'" alt="Image de la galerie">
    </div>';
}
require 'Views/Galerie.php';
?>