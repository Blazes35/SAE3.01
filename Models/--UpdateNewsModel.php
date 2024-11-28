<?php
require 'DBModel.php';

class UpdateNewsModel extends DBModel {
    public function __construct(){
        parent::__construct();
    }

    public function getNews($id){
        $query = "SELECT * FROM actualite WHERE idActualite = :id";
        $stmt = self::$db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function updateNews($idActualite, $titreActualite, $descActualite, $dateActualite, $imgActualite){
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK){
            $result = self::updateImage();
            if ($result !== false){
                $imgActualite = $result;
            }
        }
        $updateQuery = "
            UPDATE actualite 
            SET titreActualite = :titreActualite, descActualite = :descActualite, 
                dateActualite = :dateActualite, urlPhotoActualite = :imgActualite
            WHERE idActualite = :idActualite
        ";
        $stmt = self::$db->prepare($updateQuery);
        $stmt->bindParam(':titreActualite', $titreActualite, PDO::PARAM_STR);
        $stmt->bindParam(':descActualite', $descActualite, PDO::PARAM_STR);
        $stmt->bindParam(':dateActualite', $dateActualite, PDO::PARAM_STR);
        $stmt->bindParam(':imgActualite', $imgActualite, PDO::PARAM_STR);
        $stmt->bindParam(':idActualite', $idActualite, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateImage(){
        $uploadDir = 'uploads/actualites/';
        $fileName = basename($_FILES['img']['name']);
        $uploadFile = $uploadDir . $fileName;
        if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
            $imgActualite = $fileName; // On enregistre le nom du fichier
            return $imgActualite;
        }
        return false;
    }

    public function deleteNews($id){
        $deleteQuery = "DELETE FROM actualite WHERE idActualite = :idActualite";
        $stmt = self::$db->prepare($deleteQuery);
        $stmt->bindParam(':idActualite', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}