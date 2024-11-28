<?php 
require_once 'Models/UpdateProductModel.php';
$model = new UpdateProductModel();
$message = '';
$uptAff = '';

// Vérifiez que la requête est en méthode POST et que l'ID du produit est présent
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idProd'])) {
    $idProd = intval($_POST['idProd']);

    // Si on met à jour le produit
    if (isset($_POST['updateProduct'])) {
        $nomProd = $_POST['titre'];
        $descProd = $_POST['desc'];
        $prixProd = floatval($_POST['price']);
        $qtProd = intval($_POST['qt']);
        $imgProd = $_POST['currentImg']; // Valeur par défaut

        // Gestion de l'upload d'image
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/produits/';
            $fileName = basename($_FILES['img']['name']);
            $uploadFile = $uploadDir . $fileName;

            // Validation du type d'image
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['img']['type'], $allowedTypes)) {
                if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                    $imgProd = $fileName; // Enregistrez le nom du fichier
                } else {
                    $message = "Erreur lors de l'upload de l'image.";
                }
            } else {
                $message = "Seuls les fichiers image sont autorisés.";
            }
        }

        // Appel de la méthode pour mettre à jour le produit
        if (!$message) {
            $message = $model->updateProduct($idProd, $nomProd, $descProd, $prixProd, $qtProd, $imgProd);
        }
    }

    // Récupération des données du produit après mise à jour
    if (isset($idProd)) {
        $product = $model->getProduct($idProd);
    }
}

// Génération du formulaire ou affichage des erreurs
if (isset($product) && $product) {
    // Si le produit existe, affichage du formulaire pour modification
    $uptAff .= '<p>' . htmlspecialchars($message) . '</p>
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
            <img src="uploads/produits/' . htmlspecialchars($product['imgProd']) . '" alt="Image actuelle" style="max-width: 200px; height: auto;" />
        </div>
        <br>
        <button type="submit" name="updateProduct">Mettre à jour</button>
    </form>
    <br>
    <form method="POST" action="">
        <input type="hidden" name="idProd" value="' . htmlspecialchars($product['idProd']) . '" />
        <button type="submit" name="action" value="delete" style="background-color: red; color: white;">Supprimer le produit</button>
    </form>';
} else {
    if ($message) {
        $uptAff .= "<p>$message</p>";
    } else {
        $uptAff .= "<p>Aucun produit trouvé ou aucun ID fourni.</p>";
    }
}

include 'Views/UpdateProduct.php';
?>
