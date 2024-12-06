<?php 
require_once 'Models/EventModel.php';
$model = new EventModel();
$events = $model->getAllEvents();
$eventAff = '';

foreach ($events as $event){
                $eventAff.='<div class="event-card">
                    <h2 class="titre">'. htmlspecialchars($event['titreEvent']).'</h2>
                    <div class="event-img"> 
                        <img src="uploads/evenement/' . htmlspecialchars($event['imgEvent']) . '" 
    alt="' . htmlspecialchars($event['titreEvent']) . '" />
                    </div>
                    <div class="detail">
                        <p class="description">Description :  '.htmlspecialchars($event['descEvent']) .'</p>
                        <p class="capacite">Capacité : ' . htmlspecialchars($event['capaEvent']) .'</p>
                        <p class="lieu">Lieu : '. htmlspecialchars($event['lieuEvent']) .'</p>
                        <p class="date">Date : ' .htmlspecialchars($event['dateEvent']).' </p>
                        <form action="?page=DetailEvent" method="POST">
                            <input type="hidden" name="idEvent" value="' . htmlspecialchars($event['idEvent']) . '">
                            <button type="submit" class="voir-maintenant">Voir Maintenant</button>
                        </form>      
                        </a>            
                    </div>
                </div> ';
                
            } 

include 'Views/Event.php';
?>

