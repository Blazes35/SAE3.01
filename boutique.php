<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <!-- Lien pour importer les Material Icons -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
      </head>
    
    <!-- <link rel="stylesheet" href="styleguide.css" /> -->
    <link rel="stylesheet" href="../header.css" />
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

    $catch_product = "SELECT * FROM PRODUIT WHERE typeProd = 'Produit'";
    $launch = $connect->prepare($catch_product);
    $launch->execute();

    $catch_cloth = "SELECT * FROM PRODUIT 
                    INNER JOIN VETEMENT 
                    ON PRODUIT.idProd = VETEMENT.idProd 
                    WHERE typeProd = 'Vetement'";
    $launch_clothe = $connect->prepare($catch_cloth);
    $launch_clothe->execute();

    echo "<div class='titre'><h2>Nouvelles arrivées</h2></div>";
    echo "<div class='article-container'>";

    while ($product = $launch->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='article'>";            
        echo "<h3 class='titre-article'>" . htmlspecialchars($product['nomProd']) . "</h3>";
        echo "<img src='uploads/produits/" . htmlspecialchars($product['imgProd']) . "' alt='" . htmlspecialchars($product['nomProd']) . "' style='width: 360px; height: 485px; background-image: url(\"./images/vector.png\");' />";
        echo "<a href='?page=DetailProduct&id=" . urlencode($product['idProd']) . "' class='info'>";
        echo "<div>";
        echo "<p class='description'>Description : " . htmlspecialchars($product['descProd']) . "</p>";
        echo "<p class='quantite'>Quantité disponible : " . htmlspecialchars($product['qtProd']) . "</p>";
        echo "<p class='voir-maintenant'>Voir maintenant</p>";
        echo "</div>";
        
        // Prix et icône de flèche
        echo "<div class='div-prix'><p class='prix'>" . htmlspecialchars($product['prixProd']) . " €</p></div>";
        echo "<div class='div-arrow'><span class='material-symbols-outlined'>east</span></div>";
        echo "</a>";
        
        echo "</div>"; // Fermeture de la div article
    }

    echo "</div><br>";
    echo "<div class='titre'><h2>Nos Vêtements</h2></div>";
    echo "<div class='article-container'>";

    if ($launch_clothe) {
        while ($clothe = $launch_clothe->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='article'>";            
            echo "<h3 class='titre-article'>" . htmlspecialchars($clothe['nomProd']) . "</h3>";
            echo "<img src='uploads/vetements/" . htmlspecialchars($clothe['imgProd']) . "' alt='" . htmlspecialchars($clothe['nomProd']) . "' style='width: 360px; height: 485px; background-image: url(\"./images/vector.png\");' />";         
            echo "<a href='/detailArticle.php?id=" . urlencode($clothe['idProd']) . "' class='info'>";
            echo "<div>";
            echo "<p class='couleur'>Couleur : " . htmlspecialchars($clothe['couleurVetement']) . "</p>";
            echo "<p class='description'>Description : " . htmlspecialchars($clothe['descProd']) . "</p>";
            echo "<p class='quantite'>Quantité disponible : " . htmlspecialchars($clothe['qtProd']) . "</p>";
            echo "<p class='voir-maintenant'>Voir maintenant</p>";
            echo "</div>";
            
            // Prix et icône de flèche
            echo "<div class='div-prix'><p class='prix'>" . htmlspecialchars($clothe['prixProd']) . " €</p></div>";
            echo "<div class='div-arrow'><span class='material-symbols-outlined'>east</span></div>";
            echo "</a>";
            
            echo "</div>"; // Fermeture de la div article
        }

    } else {
        echo "<p>Aucun vêtement disponible actuellement.</p>";
    }

    echo "</div>";
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