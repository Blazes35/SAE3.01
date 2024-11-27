

<?php 
require_once 'Models/EventModel.php';
$model = new EventModel();
$events = $model->getAllEvents();
$eventAff = '';

foreach ($events as $event){
                $eventAff.='<div class="event-card">
                    <h2 class="titre">'. htmlspecialchars($event['titreEvent']).'</h2>
                    <div class="event-img"> 
                        <img src="uploads/evenements/' . htmlspecialchars($event['imgEvent']) . '" 
    alt="' . htmlspecialchars($event['titreEvent']) . '" />
                    </div>
                    <div class="detail">
                        <p class="description"> '.htmlspecialchars($event['descEvent']) .'</p>
                        <p class="capacite">Capacité : ' . htmlspecialchars($event['capaEvent']) .'</p>
                        <p class="lieu">Lieu : '. htmlspecialchars($event['lieuEvent']) .'</p>
                        <p class="date">Date : ' .htmlspecialchars($event['dateEvent']).' </p>
                        <a href="detailEvent.php?id=' . urlencode($event['idEvent']).'">
                        <p class="voir-maintenant">Voir Maintenant</p>
                        </a>            
                    </div>
                </div> ';
                
            } 

include 'Views/Event.php';
?>

