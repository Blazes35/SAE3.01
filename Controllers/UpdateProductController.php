<?php
require_once 'Models/UpdateProductModel.php';

// Créer une instance du modèle
$model = new UpdateProductModel();
$message = '';
$product = null;
$formHtml = '';

// Si une action est en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mise à jour du produit
    if (isset($_POST['updateProduct']) && isset($_POST['idProd'])) {
        $idProd = intval($_POST['idProd']);
        $nomProd = $_POST['titre'] ?? null;
        $descProd = $_POST['desc'] ?? null;
        $prixProd = isset($_POST['price']) ? floatval($_POST['price']) : null;
        $qtProd = isset($_POST['qt']) ? intval($_POST['qt']) : null;
        $imgProd = $_POST['currentImg'] ?? null;

        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/produit/';
            $fileName = basename($_FILES['img']['name']);
            $uploadFile = $uploadDir . $fileName;

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['img']['type'], $allowedTypes)) {
                if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                    $imgProd = $fileName;
                } else {
                    $message = "Erreur lors de l'upload de l'image.";
                }
            } else {
                $message = "Seuls les fichiers image sont autorisés.";
            }
        }

        // Mise à jour du produit
        if (!$message && $nomProd && $descProd && $prixProd !== null && $qtProd !== null) {
            $message = $model->updateProduct($idProd, $nomProd, $descProd, $prixProd, $qtProd, $imgProd);
        } else {
            $message = "Tous les champs obligatoires ne sont pas remplis.";
        }
    }

    // Suppression du produit
    if (isset($_POST['action']) && $_POST['action'] === 'delete' && isset($_POST['idProd'])) {
        $idProd = intval($_POST['idProd']);
        $message = $model->deleteProduct($idProd);
    }
}

if (isset($_POST['idProd'])) {
    $idProd = intval($_POST['idProd']);
    $product = $model->getProduct($idProd);
}

if ($product) {
    $formHtml = '<div class="formulaire">
    <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="idProd" value="' . htmlspecialchars($product['idProd']) . '" />
        <input type="hidden" name="currentImg" value="' . htmlspecialchars($product['imgProd']) . '" />
        <div>
            <label for="titre">Nom du produit</label>
            <input type="text" id="titre" name="titre" value="' . htmlspecialchars($product['nomProd']) . '" required />
        </div>
        <br>
        <div>
            <label for="desc">Description</label>
            <input type="text" id="desc" name="desc" value="' . htmlspecialchars($product['descProd']) . '" />
        </div>
        <br>
        <div>
            <label for="price">Prix</label>
            <input type="number" step="0.01" id="price" name="price" value="' . htmlspecialchars($product['prixProd']) . '" required />
        </div>
        <br>
        <div>
            <label for="qt">Quantité</label>
            <input type="number" id="qt" name="qt" value="' . htmlspecialchars($product['qtProd']) . '" required />
        </div>
        <br>
        <div>
            <label for="img">Image</label>
            <input type="file" id="img" name="img" accept="image/*" />
            <p>Image actuelle : <strong>' . htmlspecialchars($product['imgProd']) . '</strong></p>
            <img src="uploads/produit/' . htmlspecialchars($product['imgProd']) . '" alt="Image actuelle" style="max-width: 200px; height: auto;" />
        </div>
        <br>
        <button type="submit" name="updateProduct">Mettre à jour</button>
    </form>
    <br>
    <form method="POST" action="">
        <input type="hidden" name="idProd" value="' . htmlspecialchars($product['idProd']) . '" />
        <button type="submit" name="action" value="delete" style="background-color: red; color: white;">Supprimer le produit</button>
    </form>
    </div>';
    
} else {
    $formHtml = "<p>Aucun produit trouvé ou aucun ID fourni.</p>";
}

// Inclure la vue
include 'Views/UpdateProduct.php';
?>
