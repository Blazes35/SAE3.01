<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evenement</title>
</head>
<body>
    <?php 
        $connect = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
        $sql = "SELECT * FROM EVENEMENT";
        $recup_event = $connect->prepare($sql);
        $recup_event->execute();
        $events = $recup_event->fetchAll(PDO::FETCH_ASSOC); 
        echo "<h1>Les événements</h1>";
        ?>
        <?php 
        foreach($events as $event):
        ?>
        <div class="event-card">
        <div class="event-img">
           <!-- <img src="/uploads" alt=""> -->
            <div class="detail">
                <h2 class="titre"><?php echo htmlspecialchars($event['titreEvent']); ?></h2>
                <p class="description"><?php echo htmlspecialchars($event['descEvent']); ?></p>
                <p class="capacite"><?php echo htmlspecialchars($event['capaEvent']);?></p>
                <p class="lieu"><?php echo htmlspecialchars($event['lieuEvent']);?></p>
                <p class="date"><?php echo htmlspecialchars($event['dateEvent']);?></p>
                <img src="uploads/evenements/<?php echo htmlspecialchars($event['imgEvent']); ?>" 
                alt="<?php echo htmlspecialchars($event['titreEvent']); ?>" 
                style="width: 360px; height: 485px; background-image: url('./images/vector.png');" />
                <a href="detailEvent.php?id=<?php echo urlencode($event['idEvent']); ?>">
                <p class="voi-maintenant">Voir Maintenant</p>
                </a>            
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</body>
</html>