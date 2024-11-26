<?php
require_once 'Models/BasketModel.php';
$model = new BasketModel();

$total = 0;

// $connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '', [
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
// ]);

// $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;

// $sql = "SELECT idCommande, quantiteCommande, etatCommande, PRODUIT.idProd, nomProd, typeProd, prixProd, imgProd,
// CODEPROMO.idCode, nomCode, dateFin, pourcentCode, condtitionCode
// FROM COMMANDE JOIN utilisateur
// ON COMMANDE.idUser = utilisateur.idUser
// JOIN PRODUIT ON COMMANDE.idProd = PRODUIT.idPROD
// LEFT JOIN APPLIQUER ON PRODUIT.idProd = APPLIQUER.idProd
// LEFT JOIN CODEPROMO ON CODEPROMO.idCode = APPLIQUER.idCode
// WHERE adrMailUser= :email";

// $stmt = $connection->prepare($sql);

// $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);

// $stmt->execute();

$connection = $model->getDB();
// echo var_dump($_SESSION);


// $sql = "INSERT INTO COMMANDE (idUser, idProd, quantiteCommande, etatCommande) VALUES ((SELECT idUser FROM utilisateur WHERE adrMailUser = :email), 1, 2, 0)";
// $smt = $connection->prepare($sql);
// $smt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
// $smt->execute();
// $result = $smt->fetchAll();
// echo var_dump($result);


$commandes = $model->getBasket();
// echo var_dump($commandes);




// $commandes = $stmt->fetchAll();














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
$commandeAff.= '<div class="total">
                Total: ' . number_format($total, 2) . ' €
                </div>
            <div class="payer">
                <form method="POST" action="panier.php">
                    <button type="submit" name="payer" >Payer votre commande</button>
                </form>
            </div>
        </div>'; 


















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
    if(isset($_POST['idCommande'])){
        $sqlUpdate = "UPDATE COMMANDE SET etatCommande=2 WHERE idUser =  (SELECT idUser FROM utilisateur WHERE adrMailUser = :email)";
        $smtUpdate = $connection->prepare($sqlUpdate);
        $smtDelete->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
        if($smtUpdate->execute()){
            header("Location: ?page=Accueil");
            exit();
        }
    }
}
include 'Views/Basket.php';
?>