<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <!-- Lien pour importer les Material Icons -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="globals.css" />
    <!-- <link rel="stylesheet" href="styleguide.css" /> -->
</head>
<body>
    <header>
        <div class="overlap-group">
            <img class="logo" src="images/logo.png" />
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
                    <a href="presentation.html" class="calendrier" style="cursor: pointer;">QUI SOMMES NOUS</a>
                    <a href="evenement.html" class="calendrier" style="cursor: pointer;">ÉVENEMENTS</a>
                    <a href="calendrier.html" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                    <a href="galerie.html" class="calendrier" style="cursor: pointer;">GALERIE</a>
                    <a href="boutique.html" class="calendrier" style="cursor: pointer;">BOUTIQUE</a>


                </div>

<?php echo $content; ?>

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
            <p>Copyright © 2024• ADIIl - All rights reserved</p>
            <p>Site web réaliser par coco dev</p>
        </div>
    </footer>
</body>
</html>