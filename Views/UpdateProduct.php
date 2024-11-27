<?php
$title = 'Mise à jour Produit';
ob_start();
?>

<link rel="stylesheet" href="../css/updateProduct.css" />

        </div>
    </div>  
</div>
<div class="container">
<h1>Modifier ou supprimer un produit</h1>
<?php echo $uptAff;?>
</div>
<?php
$content = ob_get_clean();
include 'Layout.php';
?> 