<?php
require_once 'DBModel.php';

class DetailProductModel extends DBModel{
    public function __construct(){
        parent::__construct();
    }

    public function getProduct(int $idProd){
        $query = "SELECT * FROM PRODUIT WHERE idProd = :id";
        $stmt = self::$db->prepare($query);
        $stmt->bindParam(':id', $idProd, PDO::PARAM_INT);
        $stmt->execute();
        return ($product = $stmt->fetch(PDO::FETCH_ASSOC));
    }
    
    public function addToBasket(int $idProd){
        $qt = 1;
        $id = $_SESSION['id'];
        $date =  date('Y-m-d H:i:s');
        $query = "INSERT INTO COMMANDE (idProd,idUser,quantiteCommande,dateCommande,etatCommande) VALUES (:idProd ,:idUser, :quantiteCommande, :dateCommande, 0)";
        $stmt = self::$db->prepare($query);
        $stmt->bindParam(':idProd', $idProd, PDO::PARAM_INT);
        $stmt->bindParam(':idUser', $id, PDO::PARAM_INT);
        $stmt->bindParam(':quantiteCommande', $qt, PDO::PARAM_INT);
        $stmt->bindParam(':dateCommande', $date, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>