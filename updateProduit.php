<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un produit</title>
</head>
<body>

<?php 
    $connect = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
    $message = '';

    // Traitement de la mise à jour
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idProd'])) {
        $idProd = intval($_POST['idProd']);
        $nomProd = $_POST['titre'];
        $descProd = $_POST['desc'];
        $prixProd = floatval($_POST['price']);
        $qtProd = intval($_POST['qt']);
        $imgProd = $_POST['currentImg']; // Valeur par défaut

        // Vérification et gestion de l'upload d'image
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
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

<h1>Modifier un produit</h1>
<p><?php echo $message; ?></p>
<form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="idProd" value="<?php echo htmlspecialchars($product['idProd']); ?>" />
    <input type="hidden" name="currentImg" value="<?php echo htmlspecialchars($product['imgProd']); ?>" />

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
        <img src="uploads/<?php echo htmlspecialchars($product['imgProd']); ?>" alt="Image actuelle" style="max-width: 200px; height: auto;" />
    </div>
    <br>
    <button type="submit">Mettre à jour</button>
</form>

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
