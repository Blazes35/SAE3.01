<?php
require_once 'Models/ConnectionModel.php';
$model = new mainModel();

$total = 0;

$connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;

$sql = "SELECT idCommande, quantiteCommande, etatCommande, PRODUIT.idProd, nomProd, typeProd, prixProd, imgProd,
CODEPROMO.idCode, nomCode, dateFin, pourcentCode, condtitionCode
FROM COMMANDE JOIN utilisateur
ON COMMANDE.idUser = utilisateur.idUser
JOIN PRODUIT ON COMMANDE.idProd = PRODUIT.idPROD
LEFT JOIN APPLIQUER ON PRODUIT.idProd = APPLIQUER.idProd
LEFT JOIN CODEPROMO ON CODEPROMO.idCode = APPLIQUER.idCode
 WHERE adrMailUser= :email";

$stmt = $connection->prepare($sql);

$stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);

$stmt->execute();

$commandes = $stmt->fetchAll();

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


require 'Views/Basket.php';
?>