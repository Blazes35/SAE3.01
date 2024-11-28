<?php 
    $title = 'DetailEvent';
    ob_start();
?>
 <link rel="stylesheet" href="../css/detailEvent.css">
        </div>
    </div>
</div>
    <div class="container">
        <div class="titre"><h2>Inscription</h2></div>
       <?php echo $detailAffiche; ?>
    </div>

<?php
    $content = ob_get_clean();
    include 'Layout.php';
?>
