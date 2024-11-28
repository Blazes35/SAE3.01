<?php
require_once 'Models/DetailProductModel.php';
$model  = new DetailProductModel();
$afficheProduit ='';
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
        $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité'; 

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
        <a href='/?page=Basket&idProd=" . urlencode($idProd) . "&name=" . urlencode($product['nomProd']) . "&price=" . urlencode($product['prixProd']) . "'>
        <button class='add-to-cart'>Ajouter au panier</button>
        </a>
        </div>";

        if ($userRole  < 4) {
            
            $afficheProduit.= "
            <form action='?page=UpdateProduct' method='post'>
                <input type='hidden' name='adminPanel' value='1'>
                <input type='hidden' name='idProd' value=". $product['idProd'] ." />
                <button type='submit' name='updateProduct' class='settings'>
                <span class='material-symbols-outlined'>settings</span>
                <p>Paramétrer</p>
                </button>
            </form>";
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
