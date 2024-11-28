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

            <div class="actu-img">
                <img src="uploads/actualites/' . htmlspecialchars($actu['urlPhotoActualite']) . '" 
                    alt="' . htmlspecialchars($actu['titreActualite']) . '" />
            </div>
        </div> 

        <div class="actu-card-in"> 
            <div class="detail">
                <p class="titre">' . htmlspecialchars($actu['titreActualite']) . '</p>
                <p class="contenu">' . htmlspecialchars($actu['descActualite']) . '</p>
                <p class="date">' . htmlspecialchars($actu['dateActualite']) . '</p>

                <button><a href="detailActualite.php?id=' . urlencode($actu["idActualite"]) . '" class="info">Voir plus</a></button>';

                $userRole = isset($_SESSION['role']) ? (int)$_SESSION['role'] : 0; 
                $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité'; 

                if ($userRole < 4) {
                    $actuAff .="
                    <form action='?page=UpdateNews2' method='post'>
                        <input type='hidden' name='adminPanel' value='1'>
                        <input type='hidden' name='idActualite' value=" . $actu['idActualite'] . " />
                        <button type='submit' name='update' class='settings'>
                                <span class='material-symbols-outlined'>settings</span>
                                <p id='probleme'>Parametrer</p>
                        </button>
                    </form>";
                }

            $actuAff .= '
            </div>
        </div> 
    </div>
</div>';
        }
    

include 'Views/News.php'; 

?>