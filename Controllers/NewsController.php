<?php
require_once 'Models/NewsModel.php';
$model = new NewsModel();
$actus =$model->getNews();
$actuAff='';



foreach($actus as $actu){
    $actuAff .= '
<div class="container">
    <div class="actu-card">
        <div class="actu-card-in">
            <!-- Section Image -->
            <div class="actu-img">
                <img src="uploads/actualites/' . htmlspecialchars($actu['urlPhotoActualite']) . '" 
                    alt="' . htmlspecialchars($actu['titreActualite']) . '" />
            </div>
        </div> <!-- Fin de la section image -->

        <div class="actu-card-in"> <!-- Nouvelle section pour les détails -->
            <div class="detail">
                <p class="titre">' . htmlspecialchars($actu['titreActualite']) . '</p>
                <p class="contenu">' . htmlspecialchars($actu['descActualite']) . '</p>
                <p class="date">' . htmlspecialchars($actu['dateActualite']) . '</p>

                <button><a href="detailActualite.php?id=' . urlencode($actu["idActualite"]) . '" class="info">Voir plus</a></button>';

                $userRole = isset($_SESSION['role']) ? (int)$_SESSION['role'] : 0; // Conversion en entier
                $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité'; 

                if ($userRole < 4) { 
                    $actuAff .= '
                    <button class="settings">
                        <a href="updateActu.php?id=' . urlencode($actu['idActualite']) . '">
                            <span class="material-symbols-outlined">settings</span>
                            <p id="probleme">Paramétrer</p>
                        </a>
                    </button>';
                }

            $actuAff .= '
            </div>
        </div> 
    </div>
</div>';
        }
    

include 'Views/News.php'; 

?>