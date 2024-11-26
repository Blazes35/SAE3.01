<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test ajout produit</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="./css/ajout.css" />
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
                    <a href="ajout.php" class="editer" style="cursor: pointer;">EDITER CONTENU</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    function toggleFields() {
        // Initialisez tous les champs à false (masqué par défaut)
        const fields = {
            'desc-field': false,
            'price-field': false,
            'promo-field': false, 
            'qt-field': false, 
            'color-field': false, 
            'capacite-field': false, 
            'minRole-field': false, 
            'minGrade-field': false, 
            'lieu-field': false, 
            'date-field': false, 
            'contenuActu-field': false,
            'dateDebut-field': false,
            'dateFin-field': false,
            'conditionCode-field': false,
            'picture-field': false
        };

        // Obtenez le type d'article sélectionné
        const articleType = document.getElementById('article-select').value;

        // Configurez les champs en fonction du type d'article
        switch (articleType) {
            case 'vetement':
                fields['desc-field'] = true;
                fields['picture-field'] = true; // Montrer l'image
                fields['color-field'] = true;
                fields['price-field'] = true;
                fields['qt-field'] = true;
                break;
            case 'evenement':
                fields['desc-field'] = true;
                fields['picture-field'] = true; // Montrer l'image
                fields['capacite-field'] = true;
                fields['minRole-field'] = true;
                fields['minGrade-field'] = true;
                fields['lieu-field'] = true;
                fields['date-field'] = true;
                break;
            case 'actu':
                fields['desc-field'] = false; // Masquer le champ description
                fields['picture-field'] = true; // Montrer l'image
                fields['contenuActu-field'] = true;
                fields['date-field'] = true;
                break;
            case 'code':
                fields['promo-field'] = true;
                fields['dateDebut-field'] = true;
                fields['dateFin-field'] = true;
                fields['conditionCode-field'] = true;
                break;
            case 'produit':
                fields['desc-field'] = true;
                fields['picture-field'] = true; // Montrer l'image
                fields['price-field'] = true;
                fields['qt-field'] = true;
                break;
            default:
                break;
        }

        // Appliquez les propriétés "hidden" à chaque champ
        for (const id in fields) {
            document.getElementById(id).hidden = !fields[id];
        }
    }
</script>

</head>
<body>
<form method="post" action="ajout.php" enctype="multipart/form-data">
    <label for="choice">Choisir le type d'article :</label>
    <select name="article" id="article-select" onchange="toggleFields()">
        <option value="">--Choisir un type d'article--</option>
        <option value="produit">Produit</option>
        <option value="galerie">Galerie</option>
        <option value="evenement">Evenement</option>
        <option value="vetement">Vetement</option>
        <option value="actu">Actualité</option>
        <option value="code">Code Promotionnel</option>
    </select>

    <div id="color-field" hidden>
        <label for="color">Couleur</label>
        <input type="text" name="color" id="color">
    </div>

    <label for="title">Titre</label>
    <input type="text" name="title" id="title" required>

    <div id="desc-field">
    <label for="desc">Description</label>
    <input type="text" name="desc" id="desc">
    </div>

    <div id="picture-field">
    <label for="picture">Image</label>
    <input type="file" name="picture" id="picture">
    </div>

    <div id="price-field" hidden>
        <label for="price">Prix</label>
        <input type="text" name="price" id="price">
    </div>

    <div id="promo-field" hidden>
        <label for="reduction">Pourcentage de réduction</label>
        <input type="number" step="0.01" name="reduction" id="reduction">
    </div>

    <div id="qt-field" hidden>
        <label for="qt">Quantité</label>
        <input type="text" name="qt" id="qt">
    </div>

    <div id="capacite-field" hidden>
        <label for="capacite">Capacité</label>
        <input type="number" name="capacite" id="capacite">
    </div>

    <div id="minRole-field" hidden>
        <label for="minRole">Role minimal</label>
        <input type="text" name="minRole" id="minRole">
    </div>

    <div id="minGrade-field" hidden>
        <label for="minGrade">Grade minimal</label>
        <input type="text" name="minGrade" id="minGrade">
    </div>

    <div id="lieu-field" hidden>
        <label for="lieu">Lieu</label>
        <input type="text" name="lieu" id="lieu">
    </div>

    <div id="date-field" hidden>
        <label for="date">Date</label>
        <input type="date" name="date" id="date">
    </div>

    <div id="contenuActu-field" hidden>
        <label for="contenuActu">Contenu</label>
        <input type="text" name="contenuActu" id="contenuActu">
    </div>

    <div id="dateDebut-field" hidden>
        <label for="dateDebut">Date de début</label>
        <input type="date" name="dateDebut" id="dateDebut">
    </div>

    <div id="dateFin-field" hidden>
        <label for="dateFin">Date de fin</label>
        <input type="date" name="dateFin" id="dateFin">
    </div>

    <div id="conditionCode-field" hidden>
        <label for="conditionCode">Condition du code</label>
        <input type="text" name="conditionCode" id="conditionCode">
    </div>

    <button type="submit" name="action" value="add">Ajouter</button>
    <button type="submit" name="action" value="delete">Supprimer</button>
</form>


    <?php
    try {
        $connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        function uploadImage($file, $type) {
            $uploadDir = match ($type) {
                'produit' => 'uploads/produits/',
                'galerie' => 'uploads/galerie/',
                'evenement' => 'uploads/evenements/',
                'actu' => 'uploads/actualites/',
                'vetement' => 'uploads/vetements/',
                default => throw new Exception('Type non valide'),
            };

            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $fileName = basename($file['name']);
            $targetFilePath = $uploadDir . $fileName;
            $validTypes = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array(strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION)), $validTypes)) {
                if (move_uploaded_file($file['tmp_name'], $targetFilePath)) return $fileName;
                throw new Exception('Erreur : Téléchargement impossible.');
            }
            throw new Exception('Erreur : Format non valide.');
        }

function addArticle($connection, $data, $file) {
    $imageName = null; // Initialisez avec null
    
    // Vérifiez si une image est nécessaire pour le type d'article
    if (!in_array($data['article'], ['code'])) { 
        $imageName = uploadImage($file, $data['article']); // Chargez l'image uniquement si nécessaire
    }

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
            ':typeProd' => $data['article']
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
            ':minRole'  => $data['minRole'] ?? null,
            ':minGrade' => $data['minGrade'] ?? null
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
            ':typeProd' => $data['article']
        ]);

        $idProd = $connection->lastInsertId();
        $queryVet = "INSERT INTO VETEMENT (idProd, couleurVetement) VALUES (:idProd, :color)";
        $stmtVet = $connection->prepare($queryVet);
        $stmtVet->execute([
            ':idProd' => $idProd,
            ':color'  => $data['color']
        ]);
    } elseif ($data['article'] === 'actu') {
        $query = "INSERT INTO ACTUALITE (titreActualite, descActualite, urlPhotoActualite, dateActualite, idUser) 
                  VALUES (:title, :contenuActu, :img, :date, :idUser)";
        $stmt = $connection->prepare($query);
        $stmt->execute([
            ':title'      => $data['title'],
            ':contenuActu' => $data['contenuActu'],
            ':img'        => $imageName,
            ':date'       => $data['date'],
            ':idUser'     => 2
        ]);
    } elseif ($data['article'] === 'code') {
        // Vérifiez que tous les champs requis sont définis et valides
        
    
        // Préparation de la requête SQL
        $query = "INSERT INTO CODEPROMO (nomCode, dateDebut, dateFin, pourcentCode, conditionCode) 
                  VALUES (:title, :dateDebut, :dateFin, :pourcentCode, :conditionCode)";
        $stmt = $connection->prepare($query);
    
        // Exécution de la requête avec les valeurs sécurisées
        $stmt->execute([
            ':title'        => $data['title'],
            ':dateDebut'    => $data['dateDebut'],
            ':dateFin'      => $data['dateFin'],
            ':pourcentCode'    => $data['pourcentCode'] ?? null,
            ':co nditionCode'=> $data['conditionCode'] ?? null // Peut être null si non obligatoire
        ]);
    }
    
}       
        function deleteArticle($connection, $type, $title) {
            try {
                // Déterminer la table en fonction du type d'article
                switch ($type) {
                    case 'produit':
                    case 'vetement': // Les vêtements sont aussi dans la table PRODUIT
                        $query = "DELETE FROM PRODUIT WHERE nomProd = :title";
                        break;
        
                    case 'galerie':
                        $query = "DELETE FROM GALERIE WHERE titreGalerie = :title";
                        break;
        
                    case 'evenement':
                        $query = "DELETE FROM EVENEMENT WHERE titreEvent = :title";
                        break;
        
                    case 'actu':
                        $query = "DELETE FROM ACTUALITE WHERE titreActualite = :title";
                        break;
                    
                    case 'code':
                        $query = "DELETE FROM CODEPROMO WHERE nomCode = :title";
                        break;
        
                    default:
                        throw new Exception("Type d'article non reconnu.");
                }
        
                // Préparer et exécuter la requête
                $stmt = $connection->prepare($query);
                $stmt->execute([':title' => $title]);
        
                echo "L'article de type '$type' avec le titre '$title' a été supprimé avec succès.";
            } catch (PDOException $e) {
                echo "Erreur lors de la suppression : " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'];
            $type = $_POST['article'] ?? '';
            $title = $_POST['title'] ?? '';
        
            if ($action === 'add') {
                addArticle($connection, $_POST, $_FILES['picture']);
            } elseif ($action === 'delete') {
                if (!empty($type) && !empty($title)) {
                    deleteArticle($connection, $type, $title);
                } else {
                    echo "Veuillez sélectionner un type d'article et fournir un titre.";
                }
            }
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
</body>
</html>
