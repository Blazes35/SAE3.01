<?php
$title = 'Panier';
ob_start();
?>

<link rel="stylesheet" href="panier.css" />

        </div>
    </div>  
</div>

<div class="commandes">
        <div class=titrepanier> VOTRE PANIER </div>
    <div class="commande">
    <div class="image">
        Images
    </div>
    <div class="numCommande">
        Numéro de la commande
    </div>
    <div class="nomProduit">
        Nom du produit
    </div>
    <div class="quantiteProduit">
        Quantité
    </div>
    <div class="prixProduit">
        Prix Unitaire
    </div>
    <div class="supprimer">
        Supprimer
    </div>
</div>
<?php echo $commandeAff; ?>
<div class="total">
    <?php echo 'Total: ' . number_format($total, 2) . ' €'; ?>
</div>
    <div class="payer">
        <form method="POST" action="?page=Basket">
            <button type="submit" name="payer" >Payer votre commande</button>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
include 'Views/Layout.php';
?> 