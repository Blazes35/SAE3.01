<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="./css/updateProduit.css" />
    <link rel="stylesheet" href="header.css" />
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
<body>
<?php 
    $connect = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
    $message = '';

    // Traitement de la mise à jour
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] === 'update' && isset($_POST['idProd'])) {
            $idProd = intval($_POST['idProd']);
            $nomProd = $_POST['titre'];
            $descProd = $_POST['desc'];
            $prixProd = floatval($_POST['price']);
            $qtProd = intval($_POST['qt']);
            $imgProd = $_POST['currentImg']; // Valeur par défaut

            // Vérification et gestion de l'upload d'image
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/produits/';
                $fileName = basename($_FILES['img']['name']);
                $uploadFile = $uploadDir . $fileName;

                // Déplacement du fichier
                if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                    $imgProd = $fileName; // On enregistre uniquement le nom de fichier
                } else {
                    $message = "Erreur lors de l'upload de l'image.";
                }
            }

            // Requête SQL pour mettre à jour le produit
            $updateQuery = "
                UPDATE produit 
                SET nomProd = :nomProd, descProd = :descProd, prixProd = :prixProd, 
                    qtProd = :qtProd, imgProd = :imgProd
                WHERE idProd = :idProd
            ";
            $stmt = $connect->prepare($updateQuery);
            $stmt->bindParam(':nomProd', $nomProd, PDO::PARAM_STR);
            $stmt->bindParam(':descProd', $descProd, PDO::PARAM_STR);
            $stmt->bindParam(':prixProd', $prixProd, PDO::PARAM_STR);
            $stmt->bindParam(':qtProd', $qtProd, PDO::PARAM_INT);
            $stmt->bindParam(':imgProd', $imgProd, PDO::PARAM_STR);
            $stmt->bindParam(':idProd', $idProd, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $message = "Produit mis à jour avec succès !";
            } else {
                $message = "Erreur lors de la mise à jour du produit.";
            }
        } elseif ($_POST['action'] === 'delete' && isset($_POST['idProd'])) {
            // Suppression du produit
            $idProd = intval($_POST['idProd']);
            $deleteQuery = "DELETE FROM produit WHERE idProd = :idProd";
            $stmt = $connect->prepare($deleteQuery);
            $stmt->bindParam(':idProd', $idProd, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $message = "Produit supprimé avec succès !";
                echo "<p>$message</p>";
                exit; // Arrêt pour éviter l'affichage du formulaire
            } else {
                $message = "Erreur lors de la suppression du produit.";
            }
        }
    }

    // Affichage du formulaire avec les données actuelles du produit
    if (isset($_GET['id'])) {
        $idProd = intval($_GET['id']);
        $selectQuery = "SELECT * FROM produit WHERE idProd = :id";
        $stmt = $connect->prepare($selectQuery);
        $stmt->bindParam(':id', $idProd, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
?>

<div class="container">
<h1>Modifier ou supprimer un produit</h1>
<p><?php echo $message; ?></p>

<!-- Formulaire de mise à jour -->
<form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="idProd" value="<?php echo htmlspecialchars($product['idProd']); ?>" />
    <input type="hidden" name="currentImg" value="<?php echo htmlspecialchars($product['imgProd']); ?>" />
    <input type="hidden" name="action" value="update" />

    <div>
        <label for="titre">Nom du produit</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($product['nomProd']); ?>" required />
    </div>
    <br>
    <div>
        <label for="desc">Description</label>
        <input type="text" id="desc" name="desc" value="<?php echo htmlspecialchars($product['descProd']); ?>" />
    </div>
    <br>
    <div>
        <label for="price">Prix</label>
        <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($product['prixProd']); ?>" required />
    </div>
    <br>
    <div>
        <label for="qt">Quantité</label>
        <input type="number" id="qt" name="qt" value="<?php echo htmlspecialchars($product['qtProd']); ?>" required />
    </div>
    <br>
    <div>
        <label for="img">Image</label>
        <input type="file" id="img" name="img" accept="image/*" />
        <p>Image actuelle : <strong><?php echo htmlspecialchars($product['imgProd']); ?></strong></p>
        <img src="uploads/produits/<?php echo htmlspecialchars($product['imgProd']); ?>" alt="Image actuelle" style="max-width: 200px; height: auto;" />
    </div>
    <br>
    <button type="submit">Mettre à jour</button>
</form>

<br>

<!-- Formulaire de suppression -->
<form method="POST" action="">
    <input type="hidden" name="idProd" value="<?php echo htmlspecialchars($product['idProd']); ?>" />
    <input type="hidden" name="action" value="delete" />
    <button type="submit" style="background-color: red; color: white;">Supprimer le produit</button>
</form>
</div>
<?php
        } else {
            echo "<p>Produit introuvable.</p>";
        }
    } else {
        echo "<p>Aucun ID fourni.</p>";
    }
?>
</body>
</html>
