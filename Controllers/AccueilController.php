<?php
require_once 'Models/AccueilModel.php';
$model = new AccueilModel();
$actualites = $model->getAccueil();

$rejoinsNous = ' <div class="box-5">
    <div class="rejoins-nous">REJOINS-NOUS</div>
        <form action="?page=SignUp" method="post">
        <a href="/~inf2pj02/?page=SignUp">
            <button class="button-inscription">INSCRIPTION</button>
        </a>
        </form>
    </div>';


require 'Views/Accueil.php';
?>