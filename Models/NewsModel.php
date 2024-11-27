<?php
require_once 'DBModel.php';

class NewsModel extends DBModel{
    public function __construct(){
        parent::__construct();
    }

    public function getNews(){
        $queryActu = "SELECT idActualite, titreActualite, descActualite, dateActualite, urlPhotoActualite FROM ACTUALITE"; 
        $launch = self::$db->prepare($queryActu);
        $launch->execute();
        return($launch->fetchAll(PDO::FETCH_ASSOC));
    }
}
?>