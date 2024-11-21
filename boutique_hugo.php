<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Profils</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="boutique_hugo.css" />
</head>
<body>
    <div class="menu">
        <div class="logo-theme">
            <img class="logo" src="./images/logo-sans-fond.png" />
            <div class="theme-claire">THEME CLAIRE</div>
        </div>
        <div class="compte">
            <span class="material-symbols-outlined">account_circle</span>
            <a href="compte.html" class="mon-compte" style="cursor: pointer;">MON COMPTE</a>
        </div>
        <div class="overlap-group">
            <div class="titre-de-page">
                <div class="overlap-group-3">
                <a href="TableauBord.html" class="tableau" style="cursor: pointer;">TABLEAU DE BORD</a>
                    <a href="calendrier.php" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                    <a href="GestionProfilAdmin.php" class="profils" style="cursor: pointer;">GESTION PROFILS</a>
                    <a href="tresorie.php" class="tresorie" style="cursor: pointer;">TRÉSORIE</a>
                    <a href="parametres.html" class="parametres" style="cursor: pointer;">PARAMÈTRES</a>
                    <a href="/php/boutique_hugo.php" class="editer" style="cursor: pointer;">EDITER CONTENU</a>
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

        <div id="capacite-field">
            <label for="capacite">Capacité</label>
            <input type="number" name="capacite" id="capacite">
        </div>

        <div id="minRole-field">
            <label for="minRole">Role minimal pour participer à l'événement</label>
            <input type="text" name="minRole" id="minRole">
        </div>

        <div id="minGrade-field">
            <label for="minGrade">Grade minimal pour participer à l'événement</label>
            <input type="text" name="minGrade" id="minGrade">
        </div>

        <div id="lieu-field">
            <label for="lieu">Lieu de l'événement</label>
            <input type="text" name="lieu" id="lieu">
        </div>

        <div id="date-field">
            <label for="date">Date de l'événement</label>
            <input type="date" name="date" id="date">
        </div>

        <button type="submit" name="action" value="add">Ajouter produit</button>
        <button type="submit" name="action" value="delete">Retirer produit</button>
        <button name="action" value="see">Voir produits</button>
    </form>


    
    <?php
try {
    $connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    function uploadImage($file) {
        $uploadDir = 'uploads/';
        $fileName = basename($file['name']);
        $targetFilePath = $uploadDir . $fileName;
        $validTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION)), $validTypes)) {
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return $fileName;
            }
        }
        return null;
    }

    function addArticle($connection, $data, $file) {
        $imageName = uploadImage($file);
    
        if ($data['article'] === 'produit') {
            $query = "INSERT INTO PRODUIT (nomProd, descProd, prixProd, qtProd, imgProd, typeProd) 
                      VALUES (:title, :desc, :price, :qt, :img, :typeProd)";
            $stmt = $connection->prepare($query);
            $stmt->execute([
                ':title'    => $data['title'],
                ':desc'     => $data['desc'],
                ':price'    => $data['price'],
                ':qt'       => $data['qt'],
                ':img'      => $imageName,
                ':typeProd' => $data['article'], // Récupération du type d'article
            ]);
        } elseif ($data['article'] === 'evenement') {
            $query = "INSERT INTO EVENEMENT (titreEvent, descEvent, capaEvent, prixEvent, lieuEvent, imgEvent, dateEvent, minRoleEvent, minGradeEvent) 
                      VALUES (:title, :desc, :capacite, :price, :lieu, :img, :date, :minRole, :minGrade)";
            $stmt = $connection->prepare($query);
            $stmt->execute([
                ':title'    => $data['title'],
                ':desc'     => $data['desc'],
                ':capacite' => $data['capacite'],
                ':price'    => $data['price'],
                ':lieu'     => $data['lieu'],
                ':img'      => $imageName,
                ':date'     => $data['date'],
                ':minRole'  => $data['minRole'],
                ':minGrade' => $data['minGrade'],
            ]);
        } elseif ($data['article'] === 'vetement') {
            $queryProd = "INSERT INTO PRODUIT (nomProd, descProd, prixProd, qtProd, imgProd, typeProd) 
                          VALUES (:title, :desc, :price, :qt, :img, :typeProd)";
            $stmtProd = $connection->prepare($queryProd);
            $stmtProd->execute([
                ':title'    => $data['title'],
                ':desc'     => $data['desc'],
                ':price'    => $data['price'],
                ':qt'       => $data['qt'],
                ':img'      => $imageName,
                ':typeProd' => $data['article'], // Ajout de typeProd
            ]);
    
            $idProd = $connection->lastInsertId();
            $queryVet = "INSERT INTO VETEMENT (idProd, couleurVetement) VALUES (:idProd, :color)";
            $stmtVet = $connection->prepare($queryVet);
            $stmtVet->execute([
                ':idProd' => $idProd,
                ':color'  => $data['color'],
            ]);
        }
    }
    function deleteArticle($connection, $title) {
        $query = "DELETE FROM PRODUIT WHERE nomProd = :title";
        $stmt = $connection->prepare($query);
        $stmt->execute([':title' => $title]);
    }

    function seeArticles($connection) {
        $query = "SELECT * FROM PRODUIT";
        $stmt = $connection->query($query);
        echo "<table border='1'>";
        while ($row = $stmt->fetch()) {
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
            addArticle($connection, $_POST, $_FILES['picture']);
        } elseif ($action === 'delete') {
            deleteArticle($connection, $_POST['title']);
        } elseif ($action === 'see') {
            seeArticles($connection);
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
            const capaciteField = document.getElementById('capacite-field');
            const minRoleField = document.getElementById('minRole-field');
            const minGradeField = document.getElementById('minGrade-field');
            const lieuField = document.getElementById('lieu-field');
            const dateFieldField = document.getElementById('date-field');


            colorField.hidden = true;
            capaciteField.hidden = true;
            minRoleField.hidden = true;
            minGradeField.hidden = true;
            lieuField.hidden = true;
            dateFieldField.hidden = true;

            priceField.hidden = false;
            promoField.hidden = false;
            qtField.hidden = false;


            

            if (articleType === 'galerie') {
                priceField.hidden = true;
                promoField.hidden = true;
                qtField.hidden = true;
            } else if (articleType === 'vetement') {
                colorField.hidden = false;
            }else if(articleType === 'evenement'){
                capaciteField.hidden = false;
                minRoleField.hidden = false;
                minGradeField.hidden = false;
                lieuField.hidden = false;
                dateFieldField.hidden = false;
                qtField.hidden = true;
            }
        }
    </script>
</body>
</html>
