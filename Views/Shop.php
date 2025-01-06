<?php
$title = 'Boutique';
ob_start();
?>
<link rel="stylesheet" href="css/shop.css" />
        </div>
    </div>  
</div>
<div class='titre'><h2>Nouvelles arrivées</h2></div>
<div class='article-container'>
    <?php echo $productAff;?>
    </div><br>
    
<?php
$content = ob_get_clean();
include 'Layout.php';
?>
