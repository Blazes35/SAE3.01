<?php
require_once 'DBModel.php';

class UpdateProductModel extends DBModel{

    public function __construct() {
        parent::__construct();
    }

    public function getProduct($idProd) {
        $stmt = self::$db->prepare('SELECT * FROM PRODUIT WHERE idProd = :idProd');
        $stmt->bindParam(':idProd', $idProd, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProduct($idProd, $nomProd, $descProd, $prixProd, $qtProd, $imgProd) {
        $stmt = self::$db->prepare('
            UPDATE PRODUIT 
            SET nomProd = :nomProd, descProd = :descProd, prixProd = :prixProd, qtProd = :qtProd, imgProd = :imgProd
            WHERE idProd = :idProd
        ');
        $stmt->bindParam(':idProd', $idProd, PDO::PARAM_INT);
        $stmt->bindParam(':nomProd', $nomProd, PDO::PARAM_STR);
        $stmt->bindParam(':descProd', $descProd, PDO::PARAM_STR);
        $stmt->bindParam(':prixProd', $prixProd, PDO::PARAM_STR);
        $stmt->bindParam(':qtProd', $qtProd, PDO::PARAM_INT);
        $stmt->bindParam(':imgProd', $imgProd, PDO::PARAM_STR);
        $stmt->execute();
        return "Produit mis à jour avec succès.";
    }

    public function deleteProduct($idProd) {
        $stmt = self::$db->prepare('DELETE FROM PRODUIT WHERE idProd = :idProd');
        $stmt->bindParam(':idProd', $idProd, PDO::PARAM_INT);
        $stmt->execute();
        return "Produit supprimé avec succès.";
    }
}
?>
