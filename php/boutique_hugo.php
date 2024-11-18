<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Boutique PHP</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="boutique_hugo.css" />
</head>
<div class="menu">
    <div class="logo-theme">
        <img class="logo" src="../images/logo-sans-fond.png" />
        <div class="theme-claire">THEME CLAIRE</div>
    </div>
<div class="compte">
    <span class="material-symbols-outlined">account_circle</span>
    <a href="compte.html" class="mon-compte" style="cursor: pointer;">MON COMPTE</a>
</div>
<div class="overlap-group">
            <div class="titre-de-page">
                <div class="overlap-group-3">
                    <a href="tableau.html" class="tableau" style="cursor: pointer;">TABLEAU DE BORD</a>
                    <a href="calendrier.html" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                    <a href="profils.html" class="profils" style="cursor: pointer;">GESTION PROFILS</a>
                    <a href="tresorie.html" class="tresorie" style="cursor: pointer;">TRÉSORIE</a>
                    <a href="parametres.html" class="parametres" style="cursor: pointer;">PARAMÈTRES</a>
                    <a href="editer.html" class="editer" style="cursor: pointer;">EDITER CONTENU</a>
                </div>
        </div>
</div>
</div>
<body>
    <form method="post" action="boutique_hugo.php" enctype="multipart/form-data">
        <label for="choice">Choisir le type d'article : </label>
        <select name="article" id="article-select" onchange="toggleFields()">
            <option value="">--Choisir un type d'article--</option>
            <option value="produit">Produit</option>
            <option value="galerie">Galerie</option>
            <option value="evenement">Evenement</option>
            <option value="vetement">Vetement</option>
        </select>

        <div id="color-field" hidden>
            <label for="color">Couleur</label>
            <input type="text" name="color" id="color">
        </div>
        
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" required>

        <label for="desc">Description</label>
        <input type="text" name="desc" id="desc">

        <label for="picture">Image</label>
        <input type="file" name="picture" id="picture">

        <div id="price-field">
            <label for="price">Prix</label>
            <input type="text" name="price" id="price">
        </div>

        <div id="promo-field">
            <label for="promo">Code promotionnel</label>
            <input type="text" name="promo" id="promo">
        </div>

        <div id="qt-field">
            <label for="qt">Quantité</label>
            <input type="text" name="qt" id="qt">
        </div>

        <button type="submit" name="action" value="add">Ajouter produit</button>
        <button type="submit" name="action" value="delete">Retirer produit</button>
        <button name="action" value="see">Voir produits</button>
    </form>


    
    <?php 
    try {
        $connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');

        function addProduct($connection, $title, $type, $desc, $price, $qt, $file, $color = null) {
            $uploadDir = '../uploads/';
            $fileName = basename($file['name']);
            $targetFilePath = $uploadDir . $fileName;
        
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $validTypes = ['jpg', 'jpeg', 'png', 'gif'];
        
            if (in_array($fileType, $validTypes)) {
                if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                    // Insertion dans la table PRODUIT
                    $query_add = "INSERT INTO PRODUIT (nomProd, typeProd, descProd, prixProd, qtProd, imgProd) 
                                  VALUES (:title, :type, :desc, :price, :qt, :img)";
                    $stmt = $connection->prepare($query_add);
                    $stmt->execute([
                        ':title' => $title,
                        ':type'  => $type,
                        ':desc'  => $desc,
                        ':price' => $price,
                        ':qt'    => $qt,
                        ':img'   => $fileName
                    ]);
        
                    if ($type === "vetement" && $color) {
                        $idProd = $connection->lastInsertId(); // Récupère l'ID du produit inséré
                        $query_add_vetement = "INSERT INTO VETEMENT (idProd, couleurVetement) 
                                               VALUES (:idProd, :color)";
                        $stmt = $connection->prepare($query_add_vetement);
                        $stmt->execute([
                            ':idProd' => $idProd,
                            ':color'  => $color
                        ]);
                    }
                } else {
                    echo "Erreur : Impossible de télécharger l'image.";
                }
            } else {
                echo "Erreur : Format de fichier non valide.";
            }
        }
        

        function deleteProduct($connection, $title) {
            $query_delete = "DELETE FROM PRODUIT WHERE nomProd = :title";
            $stmt = $connection->prepare($query_delete);
            $stmt->execute([':title' => $title]);
        }

        function seeProducts(){
            $select = "SELECT * FROM PRODUIT";
            $query = $connection->prepare($select);
            $query->execute();

            echo "<table border='1'>";
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . htmlspecialchars($value) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";    
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            if ($action === 'add') {
                addProduct(
                    $connection, 
                    $_POST['title'], 
                    $_POST['article'], 
                    $_POST['desc'], 
                    $_POST['price'], 
                    $_POST['qt'], 
                    $_FILES['picture'], 
                    $_POST['color'] ?? null
                );
            } elseif ($action === 'delete') {
                deleteProduct($connection, $_POST['title']);
            } elseif ($action === 'see') {
                seeProducts();
            }
        }

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    ?>

    <script>
        function toggleFields() {
            const articleType = document.getElementById('article-select').value;

            const priceField = document.getElementById('price-field');
            const promoField = document.getElementById('promo-field');
            const qtField = document.getElementById('qt-field');
            const colorField = document.getElementById('color-field');

            // Masquer tous les champs au départ
            priceField.hidden = false;
            promoField.hidden = false;
            qtField.hidden = false;
            colorField.hidden = true;

            if (articleType === 'galerie') {
                priceField.hidden = true;
                promoField.hidden = true;
                qtField.hidden = true;
            } else if (articleType === 'vetement') {
                colorField.hidden = false;
            }
        }
    </script>
</body>
</html>
