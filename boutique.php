<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <!-- Lien pour importer les Material Icons -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
      </head>
    <link rel="stylesheet" href="boutique.css" />
    <!-- <link rel="stylesheet" href="styleguide.css" /> -->
    <link rel="stylesheet" href="header.css" />
</head>
<body>
    <?php 
    try{
        $connection = new PDO('mysql:host=localhost;dbname=inf2')
    }
    ?>
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