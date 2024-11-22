<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualité</title>
</head>
<body>
    <?php
    $connect = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
    $queryActu = "SELECT titreActualite, descActualite, dateActualite, urlPhotoActualite FROM ACTUALITE"; 
    $launch = $connect->prepare($queryActu);
    $launch->execute();
    $actus = $launch->fetchAll(PDO::FETCH_ASSOC);

    echo "<div class='titre'><h2>Actualité</h2></div>";

    ?>

    <?php 
    foreach($actus as $actu):
    ?>
    <div class="actu-card">
        <div class="actu-img">
           <!-- <img src="/uploads" alt=""> -->
            <div class="detail">
                <h2 class="titre"><?php echo htmlspecialchars($actu['titreActualite']); ?></h2>
                <p class="contenu"><?php echo htmlspecialchars($actu['descActualite']); ?></p>
                <p class="date"><?php echo htmlspecialchars($actu['dateActualite']);?></p>
                <img src="uploads/<?php echo htmlspecialchars($actu['urlPhotoActualite']); ?>" 
                alt="<?php echo htmlspecialchars($actu['titreActualite']); ?>" 
                style="width: 360px; height: 485px; background-image: url('./images/vector.png');" />
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</body>
</html>