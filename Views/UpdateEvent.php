<?php 
$title = 'Mise à jour de l evenement';
ob_start();
?>

<link rel="stylesheet" href="css/updateEvent.css"/>
</div>
    </div>
</div>

<div class="product-event">
        <h1>Mise à jour de l'evenement</h1>
        
        <div class="form-container">
            <?php echo $formHtml; ?>
        </div>
    </div>

<?php
$content = ob_get_clean();
include 'LayoutAdmin.php';
?>