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
    
        $sql = "UPDATE UTILISATEUR SET nomUser = '$nom', prenomUser = '$prenom', adrMailUser = '$mail' WHERE idUser =$id_user;";
    

        $stmt = $connection->prepare($sql);

    
            
        if ($stmt->execute()) {
                
                echo "Profil mis à jour avec succès !";
        } else {
                echo "Erreur lors de la mise à jour : " . $stmt->error;
        }
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            $_SESSION['email'] = $mail;
        }
    if (isset($_POST['supprimer'])){
        if(isset($_POST['idEvent'])){
            $idEvent = $_POST['idEvent'];
            $sqlDelete = "DELETE FROM RESERVATION WHERE idEvent = :idEvent AND idUser = :id;";
            $smtDelete = $connection->prepare($sqlDelete);
            $smtDelete->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
            $smtDelete->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);

            if($smtDelete->execute()){
                header("Location: ?page=Profil");
                exit();
            }
        }
    }
}
$eventAff ='';
foreach($events as $event){
    $eventAff .= '
    <div class="imgnom">
        <div class="imgevent">
            <img src="uploads/evenements/' . $event["imgEvent"] . '" />
        </div>>
        <div class="nomEvent">'.
            '      ' . $event['titreEvent'].'
        </div>
        <div class="supprimer">
            <form method="POST" action="/?page=Profil">
                <input type="hidden" name="idEvent" value="' . $event['idEvent'] . '">
                <button type="submit" name="supprimer">Supprimer</button>
            </form>
        </div>
    </div>';
}
require 'Views/Profil.php';
?>