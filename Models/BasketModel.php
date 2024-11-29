<?php
//Model de Basket.php
require_once 'DBModel.php';

class BasketModel extends DBModel {

    public function __construct(){
        parent::__construct();
    }

    public function getBasket() {
        $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
        $sql = "SELECT idCommande, quantiteCommande, etatCommande, PRODUIT.idProd, nomProd, typeProd, prixProd, imgProd
        FROM COMMANDE JOIN utilisateur
        ON COMMANDE.idUser = utilisateur.idUser
        JOIN PRODUIT ON COMMANDE.idProd = PRODUIT.idPROD
        WHERE adrMailUser= :email and etatCommande = 1";
        $stmt = self::$db->prepare($sql);
        $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
        $stmt->execute();
        return ($stmt->fetchAll());
    }

    public function getCodePromo(){
        $codepromo ="SELECT idCode,	nomCode,dateDebut,dateFin,pourcentCode,conditionCode FROM CODEPROMO;";
        $stmtcode = self::$db->prepare($codepromo);
        $stmtcode->execute();
        return($stmtcode->fetchAll());
    }

    public function deleteBasket(int $idCommande){
        $sqlDelete = "DELETE FROM COMMANDE WHERE idCommande = :idCommande AND idUser = :id";
        $smtDelete = self::$db->prepare($sqlDelete);
        $smtDelete->bindParam(':idCommande', $idCommande, PDO::PARAM_INT);
        $smtDelete->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        $smtDelete->execute();
        return(true);
    }

    public function updateBasket(){
        $sqlUpdate = "UPDATE COMMANDE SET etatCommande=2 WHERE idUser =  :id and etatCommande = 1" ;
        $smtUpdate = self::$db->prepare($sqlUpdate);
        $smtUpdate->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        $smtUpdate->execute();
        return(true);
    }
}
?>