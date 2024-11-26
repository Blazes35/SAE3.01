<?php

require_once 'DBModel.php';

class BasketModel extends DBModel {

    public function __construct(){
        parent::__construct();
    }

    public function getBasket() {
        $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
        $sql = "SELECT idCommande, quantiteCommande, etatCommande, PRODUIT.idProd, nomProd, typeProd, prixProd, imgProd,
        CODEPROMO.idCode, nomCode, dateFin, pourcentCode, condtitionCode
        FROM COMMANDE JOIN utilisateur
        ON COMMANDE.idUser = utilisateur.idUser
        JOIN PRODUIT ON COMMANDE.idProd = PRODUIT.idPROD
        LEFT JOIN APPLIQUER ON PRODUIT.idProd = APPLIQUER.idProd
        LEFT JOIN CODEPROMO ON CODEPROMO.idCode = APPLIQUER.idCode
        WHERE adrMailUser= :email and etatCommande = 0";
        $stmt = self::$db->prepare($sql);
        $stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
        $stmt->execute();
        return ($stmt->fetchAll());
    }
}