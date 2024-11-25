<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualités</title>
    <!-- Lien pour importer les Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="actu.css" />
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
    <?php
    $connect = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
    
    session_name('BDE');
    session_set_cookie_params(86400 * 30, "/");
    session_start();

       
    $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
    $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité'; 

    
    $queryActu = "SELECT idActualite, titreActualite, descActualite, dateActualite, urlPhotoActualite FROM ACTUALITE"; 
    $launch = $connect->prepare($queryActu);
    $launch->execute();
    $actus = $launch->fetchAll(PDO::FETCH_ASSOC);

    echo "<div class='titre'><h2>Actualité</h2></div>";

    ?>

    <?php 
    foreach($actus as $actu):
    ?>
    <div class="container">
        <div class="actu-card">
            <div class="actu-card-in">
                <div class="actu-img">
                    <img src="uploads/actualites/<?php echo htmlspecialchars($actu['urlPhotoActualite']); ?>" 
                         alt="<?php echo htmlspecialchars($actu['titreActualite']); ?>" />
                </div>
                <div class="detail">
                    <p class="titre"><?php echo htmlspecialchars($actu['titreActualite']); ?></p>
                    <p class="contenu"><?php echo htmlspecialchars($actu['descActualite']); ?></p>
                    <p class="date"><?php echo htmlspecialchars($actu['dateActualite']); ?></p>
                    <?php
                    echo "<button><a href='detailActualite.php?id=" . urlencode($actu['idActualite']) . "' class='info'>Voir plus</button>"
                ?>
                    <?php 

 
                session_name('BDE'); 
                session_start();

                $userRole = isset($_SESSION['role']) ? (int)$_SESSION['role'] : 0;  // Conversion en entier
                $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité'; 

                if ($userRole === 3) { 
                    echo "<button class='settings'>";
                    echo " <a href='updateActu.php?id=" . urlencode($actu['idActualite']) . "'>";
                    echo " <span class='material-symbols-outlined'>settings</span>"; 
                    echo "<p id='probleme'>Parametrer</p>";
                    echo " </a>";
                    echo " </button>";
                }                
                ?>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
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