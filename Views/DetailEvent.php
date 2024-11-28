<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail de l'événement</title>
    <link rel="stylesheet" href="../css/detailEvent.css">
</head>
<body>
    <div class="container">
        <div class="titre"><h2>Inscription</h2></div>
        <div class="image-gallery">
            <div class="first-img">
                <img src="<?php echo htmlspecialchars('uploads/evenements/' . $event['imgEvent']); ?>" alt="<?php echo htmlspecialchars($event['titreEvent']); ?>">
            </div>
        </div>
        <div class="event-details">
            <h1 class="event-title"><?php echo htmlspecialchars($event['titreEvent']); ?></h1>
            <p class="description"><?php echo htmlspecialchars($event['descEvent']); ?></p>
            <p class="capacite">Capacité : <?php echo htmlspecialchars($event['capaEvent']); ?></p>
            <p class="lieu">Lieu : <?php echo htmlspecialchars($event['lieuEvent']); ?></p>
            <p class="date">Date : <?php echo htmlspecialchars($event['dateEvent']); ?></p>
            <p class="price"><?php echo htmlspecialchars($event['prixEvent']); ?> €</p>
        </div>
        <div class="boutons">
            <?php if ($userRole < 4): ?>
                <a href="updateEvent.php?id=<?php echo urlencode($event['idEvent']); ?>"><button class="param">Paramétrer</button></a>
            <?php endif; ?>
            <a href="inscription.php?idEvent=<?php echo urlencode($event['idEvent']); ?>"><button class="inscrire">S'inscrire</button></a>
        </div>
    </div>

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