<?php
ob_start();
session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();

$_SESSION['email'] = 'leo.lopez@gmail.com';



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    
    <link href="https://fonts.googleapis.com/css2?family=K2D&display=swap" rel="stylesheet">
</head>
<body>
<?php
if($commandes){
    echo '<div class="commandes">';
    echo '<div class=titrepanier>';
    echo 'VOTRE PANIER';
    echo '</div>';
    echo '<div class="commande">';
        echo '<div class="image">
            Images
        </div>';
        echo '<div class="numCommande">
            Numéro de la commande
        </div>';
        echo '<div class="nomProduit">
            Nom du produit
        </div>';
        echo '<div class="quantiteProduit">
            Quantité
        </div>';
        echo '<div class="prixProduit">
            Prix Unitaire
        </div>';

        echo '<div class="supprimer">
            Supprimer
        </div>';

    echo'</div>';
    foreach($commandes as $commande){
        echo '<div class="commande">';
            echo'<div class="image">';
            if(!empty($commande['imgProd'])){
                echo '<img src="uploads/produits/' . $commande['imgProd'] . '" alt="' . $commande['nomProd'] . '" />';
            }else{
                echo '<img src="/images/avatar.png" alt="default image"/>';
            }
            echo '</div>';
            echo '<div class="numCommande">';
                echo '<p>'. $commande['idCommande'].'</p>';
            echo '</div>';
            echo '<div class="nomProduit">';
                echo'<p>'.$commande['nomProd'].'</p>';
            echo'</div>';
            echo'<div class="quantiteProduit">';
                echo'<p>'.$commande['quantiteCommande'].'</p>';
            echo'</div>';
            echo '<div class="prixProduit">';
                echo'<p>'.$commande['prixProd'].'</p>';
            echo'</div>';
            $total = $total + $commande['quantiteCommande'] * $commande['prixProd'];
        
            echo '<div class="supprimer">';
                echo '<form method="POST" action="panier.php">';
                    echo '<input type="hidden" name="idCommande" value="' . $commande['idCommande'] . '">';
                    echo '<button type="submit" name="supprimer">Supprimer</button>';
                echo '</form>';
            echo '</div>';
            echo'</div>';
    }
    echo '<div class="total">';
        echo "Total: " . number_format($total, 2) . " €"; 
    echo '</div>';

    echo '<div class="payer">';
                echo '<form method="POST" action="panier.php">';
                    echo '<button type="submit" name="payer" >Payer votre commande</button>';
                echo '</form>';
            echo '</div>';
    echo'</div>';


    
}
?> 

</body>
</html>
