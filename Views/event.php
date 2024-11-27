<?php
$title = 'Evenement';
ob_start();
?>
<link rel="stylesheet" href="./css/event.css" />


</div>
</div>
</div>
    <div class="container">
        <div class="titre">
            <h2>Les événements</h2>
        </div>
        <div class="grid">
            <?php 
            echo $eventAff;
            ?>
        </div>
    </div>

<?php
$content = ob_get_clean();
include 'Layout.php';
?> 