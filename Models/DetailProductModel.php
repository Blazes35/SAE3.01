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
}
?>