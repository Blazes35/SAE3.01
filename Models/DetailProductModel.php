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

    public function addBasket(int $idProd,int $quantity, string $date ){
        $insert = "INSERT INTO COMMANDE (quantiteCommande, dateCommande,etatCommande,idUser,idProd) VALUES (:quantity,:datet,1,:id,:idProd)";
        $stmt = self::$db->prepare($insert);
        $stmt->bindParam(':idProd', $idProd, PDO::PARAM_INT);
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':datet', $date, PDO::PARAM_STR);
        $stmt->execute();
    }
}
?>