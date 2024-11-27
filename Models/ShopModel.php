<?php
require_once 'DBModel.php';

class ShopModel extends DBModel{
    
    public function __construct(){
        parent::__construct();
    }

    public function getShopProduct(){
        $catch_product = "SELECT * FROM PRODUIT WHERE typeProd = 'Produit'";
        $launch = self::$db->prepare($catch_product);
        $launch->execute();
        return($launch->fetchAll(PDO::FETCH_ASSOC));
    }

    public function getShopClothe(){
        $catch_cloth = "SELECT * FROM PRODUIT 
                        INNER JOIN VETEMENT 
                        ON PRODUIT.idProd = VETEMENT.idProd 
                        WHERE typeProd = 'Vetement'";
        $launch_clothe = self::$db->prepare($catch_cloth);
        $launch_clothe->execute();
        return($launch_clothe->fetchAll(PDO::FETCH_ASSOC));
    }
}
?>