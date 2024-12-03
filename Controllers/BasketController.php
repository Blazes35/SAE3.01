<?php

//Controller de Bsket.php
require_once 'Models/BasketModel.php';
$model = new BasketModel();
$commandes = $model->getBasket();
$commandeAff = '';
$pourcentage='';
$total = 0;

if($commandes){
    foreach($commandes as $commande){
        $commandeAff.= '<div class="commande">
                <div class="image">';
            if(!empty($commande['imgProd'])){
                $commandeAff.='<img src="uploads/produits/' . $commande['imgProd'] . '" alt="' . $commande['nomProd'] . '" />';
            }else{
                $commandeAff.= '<img src="/images/avatar.png" alt="default image"/>';
            }
            $commandeAff.=    '</div>
                    <div class="numCommande">
                        <p>'. $commande['idCommande'].'</p>
                    </div>
                    <div class="nomProduit">
                        <p>'.$commande['nomProd'].'</p>
                    </div>
                    <div class="quantiteProduit">
                        <p>'.$commande['quantiteCommande'].'</p>
                    </div>
                    <div class="prixProduit">
                        <p>'.$commande['prixProd'].'</p>
                    </div>';
            $total = $total + $commande['quantiteCommande'] * $commande['prixProd'];
        
            $commandeAff.=    '<div class="supprimer">
                    <form method="POST" action="/?page=Basket">
                        <input type="hidden" name="idCommande" value="' . $commande['idCommande'] . '">
                        <button type="submit" name="supprimer">Supprimer</button>
                    </form>
                </div>
            </div>';
    }
}

$codes=$model->getCodePromo();
if($codes){
    foreach ($codes as $code) {
        $dateFin = new DateTime($code['dateFin']);
        $dateActuelle = new DateTime(); // Date actuelle
        
        // Si la date de fin est dans le futur ou aujourd'hui
        if ($dateFin >= $dateActuelle) {
            $pourcentage.='<div class="codepromo">
                <p>Réduction -' . $code['pourcentCode'] .'% avec la code ' . $code['nomCode'].'<p>
            </div>';
            $total = $total * (1-($code['pourcentCode']/100));
        }
    }

}

if ($_SESSION['grade'] === 3){
    $pourcentage.='<div classe="pourcentdiamant">
        <p> Réduction -10% avec votre grade diamant<p>
    </div>';
    $total = $total * 0.90;

}




if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['supprimer'])){
        if(isset($_POST['idCommande'])){
            $idCommande = $_POST['idCommande'];
            $delete = $model->deleteBasket($idCommande);
            if($delete === true){
                header("Location: /~inf2pj02/?page=Basket");
                exit();
            }
        }
    }

    if(isset($_POST['payer'])){
        if($model->updateBasket()){
            header("Location: /~inf2pj02/?page=Accueil");
            exit();
        }
    }
}

include 'Views/Basket.php';
?>