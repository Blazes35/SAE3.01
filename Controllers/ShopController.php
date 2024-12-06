<?php 
require_once 'Models/ShopModel.php';
$model = new ShopModel();
$products = $model->getShopProduct();
$productAff='';
$clothes = $model->getShopClothe();
$clotheAff='';

if(!empty($products)){
    foreach($products as $product){
        $productAff.= "<div class='article'>        
        <h3 class='titre-article'>" . htmlspecialchars($product['nomProd']) . "</h3>
        <img src='/home/~inf2pj02/uploads/produit/" . htmlspecialchars($product['imgProd']) . "' alt='" . htmlspecialchars($product['nomProd']) . "' style='width: 360px; height: 485px; background-image: url(\"./images/vector.png\");' />
        <a href='?page=DetailProduct&id=" . urlencode($product['idProd']) . "' class='info'>
        <div>
        <p class='description'>Description : " . htmlspecialchars($product['descProd']) . "</p>
        <p class='quantite'>Quantité disponible : " . htmlspecialchars($product['qtProd']) . "</p>
        <p class='voir-maintenant'>Voir maintenant</p>
        </div>
        <div class='div-prix'><p class='prix'>" . htmlspecialchars($product['prixProd']) . " €</p></div>
        <div class='div-arrow'><span class='material-symbols-outlined'>east</span></div>
        </a>
    
         </div>"; // Fermeture de la div article
    }
}else{
    $productAff.=  "<p>Aucun produit disponible actuellement.</p>";
}
    

if (!empty($clothes)) {
    foreach($clothes as $clothe) {
        $clotheAff.="<div class='article'>           
        <h3 class='titre-article'>" . htmlspecialchars($clothe['nomProd']) . "</h3>
        <img src='uploads/vetements/" . htmlspecialchars($clothe['imgProd']) . "' alt='" . htmlspecialchars($clothe['nomProd']) . "' style='width: 360px; height: 485px; background-image: url(\"./images/vector.png\");' />        
        <a href='DetailProduct?id=" . urlencode($clothe['idProd']) . "' class='info'>
        <div>
        <p class='couleur'>Couleur : " . htmlspecialchars($clothe['couleurVetement']) . "</p>
        <p class='description'>Description : " . htmlspecialchars($clothe['descProd']) . "</p>
        <p class='quantite'>Quantité disponible : " . htmlspecialchars($clothe['qtProd']) . "</p>
        <p class='voir-maintenant'>Voir maintenant</p>
        </div>
        
        <div class='div-prix'><p class='prix'>" . htmlspecialchars($clothe['prixProd']) . " €</p></div>
        <div class='div-arrow'><span class='material-symbols-outlined'>east</span></div>
        </a>
        
         </div>"; // Fermeture de la div article
    }

} else {
    $clotheAff.= "<p>Aucun vêtement disponible actuellement.</p>";
}

include 'Views/Shop.php';
?>