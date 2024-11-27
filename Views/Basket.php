<?php
session_start();

if (!isset($_SESSION['basket'])) {
    $_SESSION['basket'] = [];
}

if (isset($_GET['idProd'])) {
    $idProd = intval($_GET['idProd']);
    $quantity = 1; 
    
    if (isset($_SESSION['basket'][$idProd])) {
        $_SESSION['basket'][$idProd]['quantity'] += $quantity;
    } else {
        $_SESSION['basket'][$idProd] = [
            'id' => $idProd,
            'name' => $_GET['name'] ?? 'Produit inconnu', 
            'price' => floatval($_GET['price'] ?? 0),
            'quantity' => $quantity,
        ];
    }
}

// Calculer les détails du panier
$total = 0;
$commandeAff = '';
if (!empty($_SESSION['basket'])) {
    foreach ($_SESSION['basket'] as $item) {
        $commandeAff .= "<div class='commande'>";
        $commandeAff .= "<div class='image'>Images</div>"; 
        $commandeAff .= "<div class='numCommande'>Numéro de la commande</div>"; 
        $commandeAff .= "<div class='nomProduit'>{$item['name']}</div>";
        $commandeAff .= "<div class='quantiteProduit'>{$item['quantity']}</div>";
        $commandeAff .= "<div class='prixProduit'>{$item['price']} €</div>";
        $commandeAff .= "<div class='supprimer'>Supprimer</div>"; 
        $commandeAff .= "</div>";
        $total += $item['price'] * $item['quantity'];
    }
} else {
    $commandeAff = "<p>Votre panier est vide.</p>";
}

$pourcentage = '';

$title = 'Panier';
ob_start();
?>

<link rel="stylesheet" href="../panier.css" />

<div class="commandes">
    <div class="titrepanier">VOTRE PANIER</div>
    <div class="commande">
        <div class="image">Images</div>
        <div class="numCommande">Numéro de la commande</div>
        <div class="nomProduit">Nom du produit</div>
        <div class="quantiteProduit">Quantité</div>
        <div class="prixProduit">Prix Unitaire</div>
        <div class="supprimer">Supprimer</div>
    </div>
    <?php echo $commandeAff; ?>
    <div class="promo">
        <?php echo $pourcentage; ?>
    </div>
    <div class="total">
        <?php echo 'Total: ' . number_format($total, 2) . ' €'; ?>
    </div>
    <div class="payer">
        <form method="POST" action="checkout.php">
            <button type="submit" name="payer">Payer votre commande</button>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include '../Views/Layout.php';
?>
