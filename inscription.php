<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<?php
session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();

$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
$userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité';
$userAdrMail = isset($_SESSION['email']) ? $_SESSION['email'] : null;

if (($userRole === "2" || $userRole === "3")) {
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_GET['id'])) {
            $idEvent = intval($_GET['id']);
            
            // Vérifier si l'événement est déjà réservé pour cet utilisateur (identifié par son adresse mail)
            $query = $pdo->prepare("SELECT * FROM RESERVATION WHERE idEvent = :idEvent AND idUser = :idUser");
            $query->execute(['idEvent' => $idEvent, 'idUser' => $userAdrMail]);

            if ($query->rowCount() > 0) {
                echo "Vous avez déjà réservé cet événement.";
            } else {
                // Ajouter la réservation
                $stmt = $pdo->prepare("INSERT INTO RESERVATION (idEvent, idUser) VALUES (:idEvent, :idUser)");
                $stmt->execute(['idEvent' => $idEvent, 'idUser' => $userAdrMail]);

                echo "Réservation effectuée avec succès pour l'utilisateur : " . htmlspecialchars($userName) . ".";
            }
        } else {
            echo "Événement introuvable.";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la réservation : " . $e->getMessage();
    }
} else {
    echo "Vous n'avez pas les droits pour effectuer une réservation ou les informations sont incomplètes.";
}
?>

</body>
</html>