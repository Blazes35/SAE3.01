<?php
session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();

$_SESSION['email'] = 'leo.lopez@gmail.com';

$connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

$sql = "SELECT idCommande, quantiteCommande, etatCommande, PRODUIT.idProd, nomProd, typeProd, prixProd, imgProd,
CODEPROMO.idCode, nomCode, dateFin, pourcentCode, condtitionCode
FROM COMMANDE JOIN utilisateur
ON COMMANDE.idUser = utilisateur.idUser
JOIN PRODUIT ON COMMANDE.idProd = PRODUIT.idPROD
JOIN APPLIQUER ON PRODUIT.idProd = APPLIQUER.idProd
JOIN CODEPROMO ON CODEPROMO.idCode = APPLIQUER.idCode
 WHERE adrMailUser= :email";

$stmt = $connection->prepare($sql);

$stmt->bindParam(':email', $_SESSION['email'], PDO::PARAM_STR);

$stmt->execute();

$commandes = $stmt->fetchAll();

if($commandes){
    echo '<div class="commandes">';
    foreach($commandes as $commande){
        echo '<div class="commande">';
            if(!empty($commande['imgProd'])){
                echo'<img src="' . $commande['imgProd'] . '" alt="' . $commande['nomProd'] . '" />';
            }else{
                echo '<img src="/images/avatar.png" alt="default image"/>';
            }
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
        echo'</div>';
    }
    echo'</div>';
}
?>