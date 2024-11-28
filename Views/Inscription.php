<?php 
    $title = 'DetailEvent';
    ob_start();
?>
    <link rel="stylesheet" href="css/inscription.css">


    <div class="container">
        <h1>Inscription à l'événement</h1>
        <p><?php echo $message; ?></p>
        <span id="check" class="material-symbols-outlined">check</span>
    </div>

<?php
    $content = ob_get_clean();
    include 'Layout.php';
?>

