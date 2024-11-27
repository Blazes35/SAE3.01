<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservation</title>
</head>
<body>
<?php
session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();

$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
$userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité';
$userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : null;

// Vérification que l'e-mail est défini
if ($userEmail === null) {
    die("Erreur : Impossible d'identifier l'utilisateur. Connectez-vous.");
}

// Récupération de l'ID de l'événement
$idEvent = isset($_GET['idEvent']) ? intval($_GET['idEvent']) : null;
if (!$idEvent) {
    die("Erreur : ID d'événement manquant ou invalide.");
}

if ($userRole === 2 || $userRole === 3 || $userRole === 5) {
    try {
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $queryUser = $pdo->prepare("SELECT idUser FROM UTILISATEUR WHERE adrMailUser = :email");
        $queryUser->execute(['email' => $userEmail]);
        $user = $queryUser->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            die("Erreur : Utilisateur non trouvé dans la base de données.");
        }

        $userId = $user['idUser'];

        $query = $pdo->prepare("SELECT * FROM RESERVATION WHERE idEvent = :idEvent AND idUser = :idUser");
        $query->execute(['idEvent' => $idEvent, 'idUser' => $userId]);

        if ($query->rowCount() > 0) {
            echo "Vous avez déjà réservé cet événement.";
        } else {
            $stmt = $pdo->prepare("INSERT INTO RESERVATION (idEvent, idUser) VALUES (:idEvent, :idUser)");
            $stmt->execute(['idEvent' => $idEvent, 'idUser' => $userId]);

            echo "Réservation effectuée avec succès pour l'utilisateur : " . htmlspecialchars($userName) . ".";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de la réservation : " . $e->getMessage();
    }
} else {
    echo "Vous n'avez pas les droits pour effectuer une réservation.";
}
?>

<script>
    // Récupération des données de session envoyées depuis PHP
    var userRole = <?php echo json_encode($userRole); ?>;
    var userName = <?php echo json_encode($userName); ?>;

    // Affichage des informations dans la console
    console.log("Role de l'utilisateur : " + userRole);
    console.log("Nom de l'utilisateur : " + userName);
</script>


</body>
</html>
