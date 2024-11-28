<?php
    require_once 'Models/DetailEventModel.php';

    $model = new DetailEventModel();
    $event = $model->getEventById($_POST['idEvent']);


    $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
    $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité';

    $idEvent = isset($_POST['id']) ? intval($_POST['id']) : null;


    $detailAffiche = '';

    $detailAffiche.='<div class="image-gallery">
            <div class="first-img">
                <img src="' .htmlspecialchars('uploads/evenements/' . $event['imgEvent']) .'" alt="'. htmlspecialchars($event['titreEvent']).'">
            </div>
        </div>
        <div class="event-details">
            <h1 class="event-title">'. htmlspecialchars($event['titreEvent']).'</h1>
            <p class="description">'.htmlspecialchars($event['descEvent']).'</p>
            <p class="capacite">Capacité : '. htmlspecialchars($event['capaEvent']).'</p>
            <p class="lieu">Lieu : '. htmlspecialchars($event['lieuEvent']).'</p>
            <p class="date">Date : '. htmlspecialchars($event['dateEvent']).'</p>
            <p class="price">'. htmlspecialchars($event['prixEvent']).' €</p>
        </div>
        <div class="boutons">';
        if ($userRole < 4) {
            $detailAffiche .= '
                <form method="POST" action="?page=UpdateEvent.php" style="display:inline;">
                    <input type="hidden" name="id" value="' . htmlspecialchars($event['idEvent']) . '" />
                    <button type="submit" class="param">Paramétrer</button>
                </form>';
        }
        $detailAffiche .= 
            '<form method="POST" action="?page=Inscription" style="display:inline;">
                <input type="hidden" name="idEvent" value="' . htmlspecialchars($event['idEvent']) . '" />
                <button type="submit" class="inscrire">S\'inscrire</button>
            </form>        
    </div>';


        require 'Views/DetailEvent.php';
?>  