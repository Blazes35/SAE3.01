<?php
require_once 'Models/BasketModel.php';
$model = new BasketModel();
$commandes = $model->getBasket();
$commandeAff = '';
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
                    <form method="POST" action="?page=Basket">
                        <input type="hidden" name="idCommande" value="' . $commande['idCommande'] . '">
                        <button type="submit" name="supprimer">Supprimer</button>
                    </form>
                </div>
            </div>';
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $connection = $model->getDB();
    if (isset($_POST['supprimer'])){
        if(isset($_POST['idCommande'])){
            $idCommande = $_POST['idCommande'];
            //A changer pour les sessions
            $sqlDelete = "DELETE FROM COMMANDE WHERE idCommande = :idCommande AND idUser = (SELECT idUser FROM utilisateur WHERE adrMailUser = :email)";
            $smtDelete = $connection->prepare($sqlDelete);
            $smtDelete->bindParam(':idCommande', $idCommande, PDO::PARAM_INT);
            $smtDelete->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);

            if($smtDelete->execute()){
                header("Location: ?page=Basket");
                exit();
            }
        }
    }

    if(isset($_POST['payer'])){
            $sqlUpdate = "UPDATE COMMANDE SET etatCommande=1 WHERE idUser =  (SELECT idUser FROM utilisateur WHERE adrMailUser = :email) and etatCommande = 0" ;
            $smtUpdate = $connection->prepare($sqlUpdate);
            $smtUpdate->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
            if($smtUpdate->execute()){
                header("Location: ?page=Accueil");
                exit();
            }
    }
}

include 'Views/Basket.php';
?>