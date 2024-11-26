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



 $sqlevent = "SELECT EVENEMENT.idEvent, titreEvent, imgEvent FROM EVENEMENT JOIN RESERVATION 
 ON EVENEMENT.idEvent = RESERVATION.idEvent JOIN UTILISATEUR ON 
 UTILISATEUR.idUser = RESERVATION.idUser WHERE adrMailUser=:email";
 $stmtEvent = $connection->prepare($sqlevent);
 $stmtEvent->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);
 $stmtEvent->execute();

 $events = $stmtEvent->fetchAll();

 if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['validate'])){
        $nom = isset($_POST['nom']) ? $_POST['nom'] : $_SESSION['nom'];
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : $_SESSION['prenom'];
        $mail = isset($_POST['mail']) ? $_POST['mail'] : $_SESSION['email'];
        $id_user = $_SESSION['id'];
    
        $sql = "UPDATE UTILISATEURS SET nom = ?, prenom = ?, email = ? WHERE id_user = ?";
    

        if ($stmt = $connection->prepare($sql)) {
            $stmt->bindParam("sssi", $nom, $prenom, $mail, $id_user);
    
            
            if ($stmt->execute()) {
                
                echo "Profil mis à jour avec succès !";
            } else {
                echo "Erreur lors de la mise à jour : " . $stmt->error;
            }
    
            
            $stmt->close();
        }
    
    }
}

require 'Views/Profil.php';
?>