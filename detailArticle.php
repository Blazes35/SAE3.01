<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
    <!-- Lien pour importer les Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="header.css" />
    <link rel="stylesheet" href="produit.css" />
    <link rel="stylesheet" href="detailArticle.css" />
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
                    <a href="presentation.html" class="presentation">QUI SOMMES NOUS</a>
                    <a href="evenement.html" class="evenement">ÉVENEMENTS</a>
                    <a href="calendrier.html" class="calendrier">CALENDRIER</a>
                    <a href="galerie.html" class="galerie">GALERIE</a>
                    <a href="boutique.html" class="boutique">BOUTIQUE</a>
                </div>
            </div>
        </div>
    </div>
    <div class="product-container">
        <?php 
        // Connexion à la base de données
        $sql = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');

        // Vérification du paramètre 'id' dans l'URL
        if (isset($_GET['id'])) {
            $idProd = intval($_GET['id']);

            // Requête pour récupérer le produit
            $query = "SELECT * FROM PRODUIT WHERE idProd = :id";
            $stmt = $sql->prepare($query);
            $stmt->bindParam(':id', $idProd, PDO::PARAM_INT);
            $stmt->execute();

            // Récupération et affichage du produit
            if ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Déterminer le dossier des images
                $uploadDir = 'uploads/';
                $uploadDir .= ($product['typeProd'] === 'vetement') ? 'vetements/' : 'produits/';

                // Section des images
                echo "<div class='image-gallery'>";
                echo "<div class='first-img'>";
                echo "<img src='" . htmlspecialchars($uploadDir . $product['imgProd']) . "' alt='" . htmlspecialchars($product['nomProd']) . "' />";
                echo "</div>";
                echo "</div>";

                // Image principale
                echo "<div class='main-image'>";
                echo "<img id='main-image' src='" . htmlspecialchars($uploadDir . $product['imgProd']) . "' alt='" . htmlspecialchars($product['nomProd']) . "' />";
                echo "</div>";

                // Détails du produit
                echo "<div class='product-details'>";
                echo "<h1 class='product-title'>" . htmlspecialchars($product['nomProd']) . "</h1>";
                echo "<p class='description'>" . htmlspecialchars($product['descProd']) . "</p>";
                echo "<p class='price'>" . htmlspecialchars($product['prixProd']) . " €</p>";

                // Affichage conditionnel des tailles
                if ($product['typeProd'] === 'vetement') {
                    echo "<p class='size-title'>Sélectionner la taille</p>";
                    echo "<div class='sizes'>";
                    echo "<button class='size'>XS</button>";
                    echo "<button class='size'>M</button>";
                    echo "<button class='size'>L</button>";
                    echo "<button class='size'>XL</button>";
                    echo "</div>";
                }

                // Boutons d'action
                echo "<div class='buttons'>";
                echo "<button class='add-to-cart'>Ajouter au panier</button>";
                echo "<button class='promo-code'>% Code promotionnel</button>";
                echo "</div>";

                // Favoris et paramètres
                echo "<div class='favorites-settings'>";
                echo "<button class='add-to-favorites'>Ajouter aux favoris ♡</button>";
                echo " <a href='updProd.php?id=" . urlencode($product['idProd']) . "'><button class='settings'>";
                echo " <span class='material-symbols-outlined'>settings</span> Paramétrer";
                echo " </button></a>";
                echo "</div>";

                echo "<p class='add-element'>+ Ajouter un élément</p>";
                echo "</div>";
            } else {
                // Produit introuvable
                echo "<p>Produit introuvable.</p>";
            }
        } else {
            // Paramètre 'id' invalide
            echo "<p>Paramètre invalide.</p>";
        }
        ?>
    </div>
</body>
</html>
