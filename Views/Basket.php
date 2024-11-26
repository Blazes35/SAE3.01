<?php
$title = 'Panier';
ob_start();
?>

<link rel="stylesheet" href="panier.css" />



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
    echo '<div class="commandes">
            <div class=titrepanier VOTRE PANIER </div>
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
        </div>';
    foreach($commandes as $commande){
        echo '<div class="commande">
                <div class="image">';
            if(!empty($commande['imgProd'])){
                echo '<img src="uploads/produits/' . $commande['imgProd'] . '" alt="' . $commande['nomProd'] . '" />';
            }else{
                echo '<img src="/images/avatar.png" alt="default image"/>';
            }
            echo    '</div>
                    <div class="numCommande">
                        <p>'. $commande['idCommande'].'</p>
                    </div>
                    <div class="nomProduit">
                        <p>'.$commande['nomProd'].'</p>
                    </div>
                    <div class="quantiteProduit">
                        <p>'.$commande['quantiteCommande'].'</p>
                    </div>
                    <div class="prixProduit">
                        <p>'.$commande['prixProd'].'</p>
                    </div>';
            $total = $total + $commande['quantiteCommande'] * $commande['prixProd'];
        
            echo    '<div class="supprimer">
                    <form method="POST" action="panier.php">
                        <input type="hidden" name="idCommande" value="' . $commande['idCommande'] . '">
                        <button type="submit" name="supprimer">Supprimer</button>
                    </form>
                </div>
            </div>';
    }
    echo '<div class="total">';
        echo "Total: " . number_format($total, 2) . " €"; 
    echo '</div>
        <div class="payer">
            <form method="POST" action="panier.php">
                <button type="submit" name="payer" >Payer votre commande</button>
            </form>
        </div>
    </div>';


    
}
?> 

</body>
</html>
