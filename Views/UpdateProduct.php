<?php
$title = 'Mise à jour du produit';
ob_start();
?>

<link rel="stylesheet" href="css/updateProduct.css" />
        </div>
    </div>
</div>

<div class="product-update">
        <h1 class="titre">Mise à jour du produit</h1>
        
        <div class="form-container">
            <?php echo $formHtml; ?>
        </div>
    </div>

<?php
$content = ob_get_clean();
include 'LayoutAdmin.php';
?>
