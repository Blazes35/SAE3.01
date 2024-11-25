<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Evenement</title>
</head>
<body>
    <?php 
    $sql = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');

    if (isset($_GET['id'])) {
        $idEvent = intval($_GET['id']);
        // Requête pour récupérer l'événement
        $query = "SELECT * FROM EVENEMENT WHERE idEvent = :id";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(':id', $idEvent, PDO::PARAM_INT);
        $stmt->execute();

        if ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Déterminer le dossier des images
            $uploadDir = 'uploads/evenements/';

            // Section des images
            echo "<div class='image-gallery'>";
            echo "<div class='first-img'>";
            echo "<img src='" . htmlspecialchars($uploadDir . $event['imgEvent']) . "' alt='" . htmlspecialchars($event['titreEvent']) . "' />";
            echo "</div>";
            echo "</div>";

            // Détails de l'événement
            echo "<div class='event-details'>";
            echo "<h1 class='event-title'>" . htmlspecialchars($event['titreEvent']) . "</h1>";
            echo "<p class='description'>" . htmlspecialchars($event['descEvent']) . "</p>";
            echo "<p class='price'>" . htmlspecialchars($event['prixEvent']) . " €</p>";
            echo "</div>";
            echo "<a href='updateEvent.php?id=".urlencode($event['idEvent']) . "'><button class='param'>Paramétrer</button></a>";
        } else {
            echo "<p>Événement introuvable.</p>";
        }
    } else {
        echo "<p>Paramètre invalide.</p>";
    }
    ?>
</body>
</html>
