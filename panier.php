<?php
session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();

$_SESSION['email'] = 'leo.lopez@gmail.com';

$total = 0;

$connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$sql = "SELECT idCommande, quantiteCommande, etatCommande, PRODUIT.idProd, nomProd, typeProd, prixProd, imgProd,
CODEPROMO.idCode, nomCode, dateFin, pourcentCode, condtitionCode
FROM COMMANDE JOIN utilisateur
ON COMMANDE.idUser = utilisateur.idUser
JOIN PRODUIT ON COMMANDE.idProd = PRODUIT.idPROD
LEFT JOIN APPLIQUER ON PRODUIT.idProd = APPLIQUER.idProd
LEFT JOIN CODEPROMO ON CODEPROMO.idCode = APPLIQUER.idCode
 WHERE adrMailUser= :email";

$stmt = $connection->prepare($sql);

$stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);

$stmt->execute();

$commandes = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <link rel="stylesheet" href="panier.css" />
</head>
<body>
<?php
if($commandes){
    echo '<div class="commandes">';
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
        echo'</div>';
    }
    echo '<div class="total">';
        echo "Total: " . number_format($total, 2) . " €"; 
    echo '</div>';
    echo'</div>';
}
?> 
</body>
</html>
