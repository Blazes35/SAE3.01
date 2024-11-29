<?php
require_once 'DBModel.php';

class AccueilModel extends DBModel{
    public function __construct(){parent::__construct();}
    
    public function getAccueil(){
        $query = "SELECT idActualite, titreActualite, urlPhotoActualite FROM ACTUALITE ORDER BY dateActualite DESC LIMIT 4";
        $stmt = self::$db->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}