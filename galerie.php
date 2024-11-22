<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie</title>
    <!-- Lien pour importer les Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="galerie.css" />
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

    <h1 class="texte-1">GALERIE</h1>
    <div class="slider">
        <div class="slides">
        <?php
// Connexion à la base de données
try {
    $connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des photos
    $directory = 'uploads/galerie/';
    $images = glob($directory . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galerie</title>
    <!-- Lien pour importer les Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="galerie.css" />
    <link rel="stylesheet" href="header.css" />
    <style>
        .slides {
            width: calc(600px * <?php echo count($images); ?>); /* Ajustez ce calcul en fonction du nombre de slides */
        }
        .slides2 {
            width: calc(600px * <?php echo count($images); ?>); /* Ajustez ce calcul en fonction du nombre de slides */
        }
        @keyframes glisser1 {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(calc(-600px * <?php echo count($images); ?>));
            }
        }
        @keyframes glisser2 {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(calc(-600px * <?php echo count($images); ?>));
            }
        }
    </style>
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

    <h1 class="texte-1">GALERIE</h1>
    <div class="slider">
        <div class="slides">
            <?php foreach ($images as $image): ?>
                <div class="slide"><img src="<?php echo htmlspecialchars($image); ?>" alt="Image de la galerie"></div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="slider2">
        <div class="slides2">
            <?php foreach ($images as $image): ?>
                <div class="slide2"><img src="<?php echo htmlspecialchars($image); ?>" alt="Image de la galerie"></div>
            <?php endforeach; ?>
        </div>
    </div>
    <h1 class="texte-2">GALERIE</h1>

    <footer>
        <div class="bandeau1">
            <img class="logoF" src="images/logo.png" />
            <div>
                <p class="Contact">CONTACT</p>
            </div>
            <div>
                <p class="Mention-legal">MENTION LEGAL</p>
            </div>
            <div>
                <p class="FAQ">FAQ</p>
            </div>
        </div>
        <div class="icons-resaux">
            <img src="images/instagram.png" alt="">
            <img src="images/discord.png" alt="">
            <img src="images/email.png" alt="">
            <img src="images/tiktok.png" alt="">
        </div>
        <div class="bandeau2">
            <p class="p-footer">Copyright © 2024• ADIIl - All rights reserved</p>
            <p class="p-footer">Site web réaliser par coco dev</p>
        </div>
    </footer>

    <script src="script.js"></script> <!-- Inclure le fichier JavaScript -->
</body>
</html>