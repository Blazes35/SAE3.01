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
        echo "<a href='detailArticle.php?id=" . urlencode($product['idProd']) . "'>";
        echo "<img src='uploads/" . htmlspecialchars($product['imgProd']) . "' alt='" . htmlspecialchars($product['nomProd']) . "' style='width: 360px; height: 485px; background-image: url(\"./images/vector.png\");' />";
        echo "</a>";
        echo "<a href='detailArticle.php?id=" . urlencode($product['idProd']) . "' class='info'>";
        echo "<p class='description'>Description : " . htmlspecialchars($product['descProd']) . "</p>";
        echo "<p class='quantite'>Quantité disponible : " . htmlspecialchars($product['qtProd']) . "</p>";
        echo "<p class='voir-maintenant'>Voir maintenant</p>";
        echo "<div class='div-prix'><p class='prix'>" . htmlspecialchars($product['prixProd']) . " €</p></div>";
        echo "<div class='div-arrow'><span class='material-symbols-outlined'>east</span></div>";
        echo "</a></div>";
    }

    echo "</div><br>";
    echo "<div class='titre'><h2>Nos Vêtements</h2></div>";
    echo "<div class='article-container'>";

    if ($launch_clothe) {
        while ($clothe = $launch_clothe->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='article'>";
            
            echo "<a href='detailArticle.php?id=" . urlencode($clothe['idProd']) . "'>";
            echo "<h3 class='titre-article'>" . htmlspecialchars($clothe['nomProd']) . "</h3>";
            echo "<img src='uploads/" . htmlspecialchars($clothe['imgProd']) . "' alt='" . htmlspecialchars($clothe['nomProd']) . "' style='width: 360px; height: 485px; background-image: url(\"./images/vector.png\");' />";
            echo "</a>";
            
            echo "<a href='detailArticle.php?id=" . urlencode($clothe['idProd']) . "' class='info'>";
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