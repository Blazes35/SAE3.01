<?php

require_once 'DBModel.php';

class UpdateProductMode extends DBModel {

    public function __construct(){
        parent::__construct();
    }

    public function updateProduct(int $idProd, string $nomProd, string $descProd, float $prixProd, int $qtProd, string $imgProd){
        $updateQuery = "
        UPDATE produit 
        SET nomProd = :nomProd, descProd = :descProd, prixProd = :prixProd, 
            qtProd = :qtProd, imgProd = :imgProd
        WHERE idProd = :idProd";
        $stmt = self::$db->prepare($updateQuery);
        $stmt->bindParam(':nomProd', $nomProd, PDO::PARAM_STR);
        $stmt->bindParam(':descProd', $descProd, PDO::PARAM_STR);
        $stmt->bindParam(':prixProd', $prixProd, PDO::PARAM_STR);
        $stmt->bindParam(':qtProd', $qtProd, PDO::PARAM_INT);
        $stmt->bindParam(':imgProd', $imgProd, PDO::PARAM_STR);
        $stmt->bindParam(':idProd', $idProd, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $message = "Produit mis à jour avec succès !";
        $_SESSION['adminPanel']=0;
        header("Location: /?page=Shop");
    } else {
        $message = "Erreur lors de la mise à jour du produit.";
    }
    }


    public function deleteProduct(int $idProd){
        $deleteQuery = "DELETE FROM produit WHERE idProd = :idProd";
        $stmt = self::$db->prepare($deleteQuery);
        $stmt->bindParam(':idProd', $idProd, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['adminPanel']=0;
            header("Location: /?page=Shop");
        } else {
            $message = "Erreur lors de la suppression du produit.";
        }
    }

    public function getProduct(int $idProd):{
        $selectQuery = "SELECT * FROM produit WHERE idProd = :id";
        $stmt = self::$db->prepare($selectQuery);
        $stmt->bindParam(':id', $idProd, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>