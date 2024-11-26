<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évenement</title>
    <!-- Lien pour importer les Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="./css/event.css" />
    <link rel="stylesheet" href="header.css" />
</head>
<body>
    <header>
        <div class="overlap-group">
            <img class="logo" src="../images/logo.png" />
            <div class="theme-claire">THEME CLAIRE</div>
        </div>
        <div class="overlap-group-2">
            <span class="material-symbols-outlined">account_circle</span>
            <div class="mon-compte">MON COMPTE</div>
            <span class="material-symbols-outlined">shopping_cart</span>
        </div>
    </header>
    <div class="box">
        <div class="rectangle">
            <div class="titre-de-page">
                <div class="overlap-group-3">
                    <a href="presentation.html" class="presentation" style="cursor: pointer;">QUI SOMMES NOUS</a>
                    <a href="evenement.html" class="evenement" style="cursor: pointer;">ÉVENEMENTS</a>
                    <a href="calendrier.html" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                    <a href="galerie.html" class="galerie" style="cursor: pointer;">GALERIE</a>
                    <a href="boutique.html" class="boutique" style="cursor: pointer;">BOUTIQUE</a>
                </div>
            </div>
        </div>
    </div>
<body>
    <?php 
        $connect = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
        $sql = "SELECT * FROM EVENEMENT";
        $recup_event = $connect->prepare($sql);
        $recup_event->execute();
        $events = $recup_event->fetchAll(PDO::FETCH_ASSOC); 
        ?>

        <div class="container">
            <div class="titre">
                <h2>Les événements</h2>
            </div>
            <div class="grid">
                <?php foreach($events as $event):?>
                    <div class="event-card">
                        <h2 class="titre"><?php echo htmlspecialchars($event['titreEvent']); ?></h2>
                        <div class="event-img"> 
                            <img src="uploads/evenements/<?php echo htmlspecialchars($event['imgEvent']); ?>" 
                                alt="<?php echo htmlspecialchars($event['titreEvent']); ?>" />
                        </div>
                        <div class="detail">
                            <p class="description"><?php echo htmlspecialchars($event['descEvent']); ?></p>
                            <p class="capacite">capacité : <?php echo htmlspecialchars($event['capaEvent']);?></p>
                            <p class="lieu">Lieu : <?php echo htmlspecialchars($event['lieuEvent']);?></p>
                            <p class="date">Date : <?php echo htmlspecialchars($event['dateEvent']);?></p>
                            <a href="detailEvent.php?id=<?php echo urlencode($event['idEvent']); ?>">
                                <p class="voi-maintenant">Voir Maintenant</p>
                            </a>            
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
        </div>
    
</body>
</html>