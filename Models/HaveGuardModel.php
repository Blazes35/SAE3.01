<?php
require_once 'DBModel.php';

class HaveGuardModel extends DBModel{
    public function __construct(){
        parent::__construct();
    }

    public function updateGuard(int $grade){
        $sqlUpdate="UPDATE UTILISATEUR SET idGrade =:grade WHERE idUser=:id;";
        $stmt = self::$db->prepare($sqlUpdate);
        $stmt->bindParam(':grade',$grade,PDO::PARAM_INT);
        $stmt->bindParam(':id', $_SESSION['id'],PDO::PARAM_INT);
        $stmt->execute();
        return true;
    }

    public function getNameGuard(int $grade){
        $sqlSelect="SELECT nomGrade FROM GRADE WHERE idGrade=:grade;";
        $stmtSelect = self::$db->prepare($sqlSelect);
        $stmtSelect->bindParam(':grade',$grade,PDO::PARAM_INT);
        $stmtSelect->execute();
        return ($stmtSelect->fetch(PDO::FETCH_ASSOC));
    }
}