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
<?php
echo $commandeAff;
$content = ob_get_clean();
include 'Views/Layout.php';
?> 