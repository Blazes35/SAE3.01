<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
</head>
<body>
    <?php
    

    $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
    $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité';

    $idEvent = isset($_GET['idEvent']) ? intval($_GET['idEvent']) : null;

    if (($userRole === "2" || $userRole === "3") && $idEvent !== null && $userId !== null) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = $pdo->prepare("SELECT * FROM RESERVATION WHERE idEvent = :idEvent AND idUser = :idUser");
            $query->execute(['idEvent' => $idEvent, 'idUser' => $userId]);
            
            if ($query->rowCount() > 0) {
                echo "Vous avez déjà réservé cet événement.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO RESERVATION (idEvent, idUser) VALUES (:idEvent, :idUser)");
                $stmt->execute(['idEvent' => $idEvent, 'idUser' => $userId]);

                echo "Réservation effectuée avec succès pour l'utilisateur : $userName.";
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
