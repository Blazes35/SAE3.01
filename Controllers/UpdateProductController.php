<?php 
require_once 'Models/UpdateProductModel.php';
$model = new UpdateProductMode();
$message = '';
$uptAff='';

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
            updateProduct($idProd, $nomProd, $descProd, $prixProd, $qtProd, $imgProd);

        } elseif ($_POST['action'] === 'delete' && isset($_POST['idProd'])) {
            deleteProduct(intval($_POST['idProd']));
        }
    }

    // Affichage du formulaire avec les données actuelles du produit
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateProduit'])) {

        $product = getProduct($_POST['idProd']);

        if ($product) {

$uptAff.= '<p>'. $message .'</p>

<form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="idProd" value="'. htmlspecialchars($product['idProd']).'" />
    <input type="hidden" name="currentImg" value="'. htmlspecialchars($product['imgProd']).'" />
    <div>
        <label for="titre">Nom du produit</label>
        <input type="text" id="titre" name="titre" value="'. htmlspecialchars($product['nomProd']).'" required />
    </div>
    <br>
    <div>
        <label for="desc">Description</label>
        <input type="text" id="desc" name="desc" value="'. htmlspecialchars($product['descProd']).'" />
    </div>
    <br>
    <div>
        <label for="price">Prix</label>
        <input type="number" step="0.01" id="price" name="price" value="'. htmlspecialchars($product['prixProd']).'" required />
    </div>
    <br>
    <div>
        <label for="qt">Quantité</label>
        <input type="number" id="qt" name="qt" value="'. htmlspecialchars($product['qtProd']).'" required />
    </div>
    <br>
    <div>
        <label for="img">Image</label>
        <input type="file" id="img" name="img" accept="image/*" />
        <p>Image actuelle : <strong>.' htmlspecialchars($product['imgProd']).'</strong></p>
        <img src="uploads/produits/'. htmlspecialchars($product['imgProd']).'" alt="Image actuelle" style="max-width: 200px; height: auto;" />
    </div>
    <br>
    <button type="submit" name="action" value="update" >Mettre à jour</button>
</form>

<br>

<form method="POST" action="">
    <input type="hidden" name="idProd" value="'. htmlspecialchars($product['idProd']).'" />
    <button type="submit" name="action" value="delete" style="background-color: red; color: white;">Supprimer le produit</button>
</form>';
        } else {
            $uptAff.="<p>Produit introuvable.</p>";
        }
    } else {
        $uptAff.="<p>Aucun ID fourni.</p>";
    }

include 'Views/UpdateProduct.php';
?>