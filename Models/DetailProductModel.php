<?php
require_once 'DBModel.php';

class DetailProductModel extends DBModel {
    public function __construct() {
        parent::__construct();
    }

    public function getProduct(int $idProd) {
        $query = "SELECT * FROM PRODUIT WHERE idProd = :id";
        $stmt = self::$db->prepare($query);
        $stmt->bindParam(':id', $idProd, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addBasket(int $idProd, int $quantity, string $date) {
        $product = $this->getProduct($idProd);
        if ($product['qtProd'] < $quantity) {
            return "Stock insuffisant.";
        }

        $insert = "INSERT INTO COMMANDE (quantiteCommande, dateCommande, etatCommande, idUser, idProd) VALUES (:quantity, :datet, 1, :id, :idProd)";
        $stmt = self::$db->prepare($insert);
        $stmt->bindParam(':idProd', $idProd, PDO::PARAM_INT);
        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':datet', $date, PDO::PARAM_STR);
        $stmt->execute();

        $this->decrementStock($idProd, $quantity);

        return "Commande effectuée avec succès.";
    }

    public function decrementStock(int $idProd, int $quantity) {
        $stmt = self::$db->prepare("UPDATE PRODUIT SET qtProd = qtProd - :quantity WHERE idProd = :idProd AND qtProd >= :quantity");
        $stmt->bindParam(':idProd', $idProd, PDO::PARAM_INT);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>