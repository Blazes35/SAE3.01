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


        $afficheProduit.= '<div class="buttons">
        <form method="POST" action="?page=DetailProduct">
        <input type="hidden" name="idProd" value="'. htmlspecialchars($idProd). '">
        <input type="hidden" name="name" value="'.htmlspecialchars($product['nomProd']) .'">
        <input type="hidden" name="price" value="'. htmlspecialchars($product['prixProd']) .'">
        <label for="quantity">Quantité :</label>
        <input type="number" id="quantity" name="quantity" value="1" min="1" max="100" required>
        <button type="submit" class="add-to-cart">Ajouter au panier</button>
        </form>
        </div>';


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
        </div>";
    }
}
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['idProd']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity'])) {
            $idProd = $_POST['idProd'];      // Récupère l'ID du produit
            $name = $_POST['name'];          // Récupère le nom du produit
            $price = $_POST['price'];        // Récupère le prix du produit
            $quantity = $_POST['quantity'];  // Récupère la quantité du produit
            $currentDateTime = date('Y-m-d H:i:s'); // Récupère la date et l'heure actuelles
            // Vous pouvez maintenant appeler la fonction addBasket pour ajouter l'article au panier
            $model->addBasket($idProd, $quantity, $currentDateTime);
            header('Location: ?page=Basket');  // Remplacez par l'URL de votre page panier
            exit();
        }
    }
include 'Views/DetailProduct.php'
?>
