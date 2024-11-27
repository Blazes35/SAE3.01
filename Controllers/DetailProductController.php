<?php
require_once 'Models/DetailProductModel.php';
$model  = new DetailProductModel();
$afficheProduit ='';
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
        $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité'; 

if (isset($_POST['Basket'])) {
    $idProd = intval($_POST['idProd']);
    $name = htmlspecialchars($_POST['name']);
    $price =  htmlspecialchars($_POST['price']);
    $result = $model->addToBasket($idProd, $name, $price);
    header('Location: /?page=Basket');
}

if (isset($_GET['id'])) {
    $idProd = intval($_GET['id']);
    $product = $model->getProduct($idProd);
    if($product){
        $uploadDir = 'uploads/';
        $uploadDir .= ($product['typeProd'] === 'vetement') ? 'vetements/' : 'produits/';

        $afficheProduit.= "<div class='image-gallery'>
            <div class='first-img'>
                <img src='" . htmlspecialchars($uploadDir . $product['imgProd']) . "' alt='" . htmlspecialchars($product['nomProd']) . "' />
            </div>
        </div>

        <div class='main-image'>
        <img id='main-image' src='" . htmlspecialchars($uploadDir . $product['imgProd']) . "' alt='" . htmlspecialchars($product['nomProd']) . "' />
        </div>

        <div class='product-details'>
        <h1 class='product-title'>" . htmlspecialchars($product['nomProd']) . "</h1>
        <p class='description'>" . htmlspecialchars($product['descProd']) . "</p>
        <p class='price'>" . htmlspecialchars($product['prixProd']) . " €</p>";

        if ($product['typeProd'] === 'vetement') {
            $afficheProduit.= "<p class='size-title'>Sélectionner la taille</p>
            <div class='sizes'>
            <button class='size'>XS</button>
            <button class='size'>M</button>
            <button class='size'>L</button>
            <button class='size'>XL</button>
            </div>";
        }

        $afficheProduit.= "<div class='buttons'>
        <form action='/?page=DetailProduct' method='POST'>
            <!-- Champ caché pour l'ID du produit -->
            <input type='hidden' name='idProd' value='" . htmlspecialchars($idProd) . "'>
            <!-- Champ caché pour le nom du produit -->
            <input type='hidden' name='name' value='" . htmlspecialchars($product['nomProd']) . "'>
            <!-- Champ caché pour le prix du produit -->
            <input type='hidden' name='price' value='" . htmlspecialchars($product['prixProd']) . "'>
            <!-- Bouton pour soumettre le formulaire -->
            <button name='Basket' type='submit' class='add-to-cart'>Ajouter au panier</button>
        </form>        
        </a>
        </div>
        <div class='favorites-settings'>
        <button class='add-to-favorites'>Ajouter aux favoris ♡</button>";

        if ($userRole > "3") {
            $afficheProduit.= "<button class='settings'>
            <a href='updateProduit.php?id=" . urlencode($product['idProd']) . "'>
            <span class='material-symbols-outlined'>settings</span>
            <p id='probleme'>Parametrer</p>
            </a>
            </button>";
        }

        $afficheProduit.= "</div>

        <p class='add-element'>+ Ajouter un élément</p>
        </div>";
    } else {
        $afficheProduit.= "<p>Produit introuvable.</p>";
    }
} else {
    $afficheProduit.= "<p>Paramètre invalide.</p>";
    }

include 'Views/DetailProduct.php'
?>
