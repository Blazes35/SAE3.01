<?php
$title = 'DetailProduct';
ob_start();
?>
<link rel="stylesheet" href="css/detailProduct.css"/>
        </div>
    </div>  
</div>
<div class="product-container">
        <?php 
        echo $afficheProduit;
        ?>
    </div>
<?php
$content = ob_get_clean();
include 'Layout.php';
?> 