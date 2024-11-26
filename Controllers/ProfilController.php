<?php
require_once 'Models/DBModel.php';
$model = new DBModel();
$connection=$model->getDB();


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connect'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if ($controller->login($email, $password)) {
        header("Location: ?page=Presentation");
        exit();
    }else{
        echo "<script>alert(\"Identifiants incorrects\")</script>";
    }
}

$sql = "SELECT nomUser, prenomUser, idGrade, ROLE.idRole, nomRole FROM UTILISATEUR LEFT JOIN POSSEDER 
ON UTILISATEUR.idUser =POSSEDER.idUser LEFT JOIN ROLE ON ROLE.idRole=POSSEDER.idRole WHERE adrMailUser=:email";
$stmt = $connection->prepare($sql);
$stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
$stmt->execute();

 $user = $stmt->fetch();

 $sqlevent = "SELECT EVENEMENT.idEvent, titreEvent, imgEvent FROM EVENEMENT JOIN RESERVATION 
 ON EVENEMENT.idEvent = RESERVATION.idEvent JOIN UTILISATEUR ON 
 UTILISATEUR.idUser = RESERVATION.idUser WHERE adrMailUser=:email";
 $stmtEvent = $connection->prepare($sqlevent);
 $stmtEvent->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
 $stmtEvent->execute();

 $events = $stmtEvent->fetchAll();

require 'Views/Profil.php';
?>