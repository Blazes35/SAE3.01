<?php
$title = 'DetailProduct';
ob_start();
?>

<link rel="stylesheet" href="./css/detailArticle.css" />
        </div>
    </div>  
</div>

<div class="product-container">
        <?php 
        echo $afficheProduit;
        ?>

        <script>
            var userRole = <?php echo json_encode($userRole); ?>;
            var userName = <?php echo json_encode($userName); ?>;

            console.log("Role de l'utilisateur : " + userRole);
            console.log("Nom de l'utilisateur : " + userName);

        </script>
    </div>
    
<?php
$content = ob_get_clean();
include 'Layout.php';
?> 