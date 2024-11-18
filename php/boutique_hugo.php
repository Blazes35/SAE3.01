<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Boutique PHP</title>
</head>
<body>
    <form method="post" action="boutique_hugo.php" enctype="multipart/form-data">
        <label for="choice">Choisir le type d'article : </label>
        <select name="article" id="article-select">
            <option value="">--Choisir un type d'article--</option>
            <option value="produit">Produit</option>
            <option value="galerie">Galerie</option>
            <option value="evenement">Evenement</option>
        </select>
        <label for="title">Titre</label>
        <input type="text" name="title" id="title" required>
        <label for="desc">Description</label>
        <input type="text" name="desc" id="desc">
        <label for="picture">Image</label>
        <input type="file" name="picture" id="picture">
        <label for="price">Prix</label>
        <input type="text" name="price" id="price">
        <label for="promo">Code promotionnel</label>
        <input type="text" name="promo" id="promo">
        <label for="qt">Quantité</label>
        <input type="text" name="qt" id="qt">
        <button type="submit" name="action" value="add">Ajouter produit</button>
        <button type="submit" name="action" value="delete">Retirer produit</button>
        <button name="action" value="see">Voir produits</button>
    </form>

    <?php 
    try {
        $connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');

        function addProduct($connection, $title, $type, $desc, $price, $qt, $file) {
            $uploadDir = 'uploads/';
            $fileName = basename($file['name']);
            $targetFilePath = $uploadDir . $fileName;
        
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $validTypes = ['jpg', 'jpeg', 'png', 'gif'];
        
            if (in_array($fileType, $validTypes)) {
                if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
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
                    $_FILES['picture']
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
</body>
</html>
