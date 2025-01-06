<?php
require_once 'Models/DetailProductModel.php';
$model  = new DetailProductModel();
$afficheProduit = '';

if (isset($_SESSION['id'])) {
    $userRole = $_SESSION['role'];
    $userName = $_SESSION['nom'];
}

if (isset($_GET['id'])) {
    $idProd = intval($_GET['id']);
    $product = $model->getProduct($idProd);
    if ($product) {
        $uploadDir = 'uploads/';
        $uploadDir .= ($product['typeProd'] === 'vetement') ? 'vetements/' : 'produit/';

        $afficheProduit .= "<div class='image-gallery'>
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
            $afficheProduit .= "<p class='size-title'>Sélectionner la taille</p>
            <div class='sizes'>
            <button class='size'>XS</button>
            <button class='size'>M</button>
            <button class='size'>L</button>
            <button class='size'>XL</button>
            </div>";
        }

        $afficheProduit .= "<p class='stock'>Stock : " . htmlspecialchars($product['qtProd']) . "</p>";

        if (isset($_POST['addBasket']) && $_POST['addBasket'] == 1) {
            if(!isset($_SESSION['id'])){
                header('Location: ?page=Login');
                exit;
            }
            $quantity = intval($_POST['quantity']);
            $date = date('Y-m-d');
            $message = $model->addBasket($idProd, $quantity, $date);
            header('Location: ?page=Basket'); // Redirection vers la page du panier
            exit(); //test
        } else {
            $afficheProduit .= '
            <form action="?page=DetailProduct&id=' . $idProd . '" method="POST">
                <input name="addBasket" type="hidden" value="1">
                <input name="quantity" type="number" min="1" max="' . $product['qtProd'] . '" value="1" id="quantity">
                <button class="add-to-basket" type="submit">Ajouter au panier</button>
            </form>';
        }

        if (isset($userRole) ? $userRole < 4 : false) {
            $afficheProduit .= "
            <form action='?page=UpdateProduct' method='post'>
                <input type='hidden' name='adminPanel' value='1'>
                <input type='hidden' name='idProd' value='" . $product['idProd'] . "' />
                <button type='submit' name='update' class='settings'>
                    <span class='material-symbols-outlined'>settings</span>
                    <p id='probleme'>Paramétrer</p>
                </button>
            </form>";
        }

        $afficheProduit .= '</div>';
    } else {
        $afficheProduit .= '<p>Produit introuvable.</p>';
    }
}

require 'Views/DetailProduct.php';
?>