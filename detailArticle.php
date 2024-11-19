<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
        <!-- Lien pour importer les Material Icons -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
      </head>
    <link rel="stylesheet" href="header.css" />
    <link rel="stylesheet" href="produit.css" />
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
                    <a href="presentation.html" class="presentation" style="cursor: pointer;">QUI SOMMES NOUS</a>
                    <a href="evenement.html" class="evenement" style="cursor: pointer;">ÉVENEMENTS</a>
                    <a href="calendrier.html" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                    <a href="galerie.html" class="galerie" style="cursor: pointer;">GALERIE</a>
                    <a href="boutique.html" class="boutique" style="cursor: pointer;">BOUTIQUE</a>
                </div>
            </div>
        </div>
    </div>
    <div class="product-container">
        <?php 
        $sql = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
        if (isset($_GET['id'])) {
            $idProd = intval($_GET['id']);
            $recup_info = "SELECT * FROM PRODUIT WHERE idProd = :id";
            $init = $sql->prepare($recup_info);
            $init->bindParam(':id', $idProd, PDO::PARAM_INT);
            $init->execute();
            if ($product = $init->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='image-gallery'>";
                echo "<div class='first-img'>";
                echo "<img src='uploads/" . htmlspecialchars($product['imgProd']) . "' alt='" . htmlspecialchars($product['nomProd']) . "' />";
                echo "</div>";
                echo "</div>";

                echo "<div class='main-image'>";
                echo "<img id='main-image' src='uploads/" . htmlspecialchars($product['imgProd']) . "' alt='" . htmlspecialchars($product['nomProd']) . "' />";
                echo "</div>";

                echo "<div class='product-details'>";
                echo "<h1 class='product-title'>" . htmlspecialchars($product['nomProd']) . "</h1>";
                echo "<p class='description'>" . htmlspecialchars($product['descProd']) . "</p>";
                echo "<p class='price'>" . htmlspecialchars($product['prixProd']) . " €</p>";
                echo "<p class='size-title'>Sélectionner la taille</p>";
                echo "<div class='sizes'>";
                echo "<button class='size'>XS</button>";
                echo "<button class='size'>M</button>";
                echo "<button class='size'>L</button>";
                echo "<button class='size'>XL</button>";
                echo "</div>";
                echo "<div class='buttons'>";
                echo "<button class='add-to-cart'>Ajouter au panier</button>";
                echo "<button class='promo-code'>% Code promotionnel</button>";
                echo "</div>";
                echo "<div class='favorites-settings'>";
                echo "<button class='add-to-favorites'>Ajouter au favoris ♡</button>";
                echo "<button class='settings'><span class='material-symbols-outlined'>settings</span>Paramétrer</button>";
                echo "</div>";
                echo "<p class='add-element'>+ Ajouter un élément</p>";
                echo "</div>";
            } else {
                echo "<p>Produit introuvable.</p>";
            }
        } else {
            echo "<p>Paramètre invalide.</p>";
        }
        ?>
    </div>
</body>
</html>