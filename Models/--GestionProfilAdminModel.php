<?php
require_once 'DBModel.php';

class GestionProfilAdminModel extends DBModel {

    public function __construct(){
        parent::__construct();
    }

    public function getProfil(){
        $info_person = "SELECT UTILISATEUR.idUser, UTILISATEUR.nomUser, POSSEDER.idRole FROM UTILISATEUR INNER JOIN POSSEDER ON UTILISATEUR.idUser = POSSEDER.idUser";
        $result = self::$db->prepare($info_person);
        $result->execute(); 
        return ($result->fetchAll((PDO::FETCH_ASSOC)));
    }

    public function updateRole($idUser, $idRole){
        $updateRole = "UPDATE POSSEDER SET idRole = :idRole WHERE idUser = :idUser";
        $stmt = self::$db->prepare($updateRole);
        $stmt->bindParam(':idRole', $idRole, PDO::PARAM_INT);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();    
    }
}

