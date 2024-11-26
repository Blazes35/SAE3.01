<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="header.css" />
    <link rel="stylesheet" href="produit.css" />
    <link rel="stylesheet" href="./css/detailArticle.css" />
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
        $sql = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');

        session_name('BDE');
        session_set_cookie_params(86400 * 30, "/");
        session_start();

       
        $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
        $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité'; 

        if (isset($_GET['id'])) {
            $idProd = intval($_GET['id']);

            $query = "SELECT * FROM PRODUIT WHERE idProd = :id";
            $stmt = $sql->prepare($query);
            $stmt->bindParam(':id', $idProd, PDO::PARAM_INT);
            $stmt->execute();

            if ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $uploadDir = 'uploads/';
                $uploadDir .= ($product['typeProd'] === 'vetement') ? 'vetements/' : 'produits/';

                echo "<div class='image-gallery'>";
                echo "<div class='first-img'>";
                echo "<img src='" . htmlspecialchars($uploadDir . $product['imgProd']) . "' alt='" . htmlspecialchars($product['nomProd']) . "' />";
                echo "</div>";
                echo "</div>";

                echo "<div class='main-image'>";
                echo "<img id='main-image' src='" . htmlspecialchars($uploadDir . $product['imgProd']) . "' alt='" . htmlspecialchars($product['nomProd']) . "' />";
                echo "</div>";

                echo "<div class='product-details'>";
                echo "<h1 class='product-title'>" . htmlspecialchars($product['nomProd']) . "</h1>";
                echo "<p class='description'>" . htmlspecialchars($product['descProd']) . "</p>";
                echo "<p class='price'>" . htmlspecialchars($product['prixProd']) . " €</p>";

                if ($product['typeProd'] === 'vetement') {
                    echo "<p class='size-title'>Sélectionner la taille</p>";
                    echo "<div class='sizes'>";
                    echo "<button class='size'>XS</button>";
                    echo "<button class='size'>M</button>";
                    echo "<button class='size'>L</button>";
                    echo "<button class='size'>XL</button>";
                    echo "</div>";
                }

                echo "<div class='buttons'>";
                echo "<button class='add-to-cart'>Ajouter au panier</button>";
                echo "<button class='promo-code'>% Code promotionnel</button>";
                echo "</div>";

                echo "<div class='favorites-settings'>";
                echo "<button class='add-to-favorites'>Ajouter aux favoris ♡</button>";

                if ($userRole === "3") {
                    echo "<button class='settings'>";
                    echo " <a href='updateProduit.php?id=" . urlencode($product['idProd']) . "'>";
                    echo " <span class='material-symbols-outlined'>settings</span>"; 
                    echo "<p id='probleme'>Parametrer</p>";
                    echo " </a>";
                    echo " </button>";
                }

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

        <script>
            var userRole = <?php echo json_encode($userRole); ?>;
            var userName = <?php echo json_encode($userName); ?>;

            console.log("Role de l'utilisateur : " + userRole);
            console.log("Nom de l'utilisateur : " + userName);

        </script>
    </div>
</body>
</html>
