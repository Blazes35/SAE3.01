<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/layout.css">
        <!-- Lien pour importer les Material Icons -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
    <header>
        <div class="overlap-group">
            <a href="">
            <img class="logo" src="images/logo.png" />
            </a>
            <div class="theme-claire">THEME CLAIRE</div>
            
        </div>
        <div class="overlap-group-2">
            <span class="material-symbols-outlined">account_circle</span>
            <div class="mon-compte">MON COMPTE</div>
            <span id="test" class="material-symbols-outlined">shopping_cart</span>
        </div>
    </header>

    <div class="box">
        <div class="rectangle">
            <div class="titre-de-page">
                <div class="overlap-group-3">
                    <form method="GET" action="">
                        <input type="hidden" name="page" value="presentation">
                        <button type="submit" class="calendrier" style="cursor: pointer; background: none; border: none; color: inherit; text-decoration: none;">QUI SOMMES NOUS</button>
                    </form>
                    <form method="GET" action="">
                        <input type="hidden" name="page" value="evenement">
                        <button type="submit" class="calendrier" style="cursor: pointer; background: none; border: none; color: inherit; text-decoration: none;">ÉVENEMENTS</button>
                    </form>
                    <form method="GET" action="">
                        <input type="hidden" name="page" value="calendrier">
                        <button type="submit" class="calendrier" style="cursor: pointer; background: none; border: none; color: inherit; text-decoration: none;">CALENDRIER</button>
                    </form>
                    <form method="GET" action="">
                        <input type="hidden" name="page" value="galerie">
                        <button type="submit" class="calendrier" style="cursor: pointer; background: none; border: none; color: inherit; text-decoration: none;">GALERIE</button>
                    </form>
                    <form method="GET" action="">
                        <input type="hidden" name="page" value="boutique">
                        <button type="submit" class="calendrier" style="cursor: pointer; background: none; border: none; color: inherit; text-decoration: none;">BOUTIQUE</button>
                    </form>
                </div>
            

    <?php echo $content ?>

<footer>
        <div class="bandeau1">
            <img id="logoF" src="images/logo.png" />
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