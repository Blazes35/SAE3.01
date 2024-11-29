<?php
    $title = 'Galerie';
    ob_start();
?>
    <link rel="stylesheet" href="css/galerie.css" />
            </div>
        </div>
    </div>
    <h1 class="texte-1">GALERIE</h1>
    <div class="gallery">
        <?php
            echo $afficheImage;
        ?>
    </div>
    <h1 class="texte-2">GALERIE</h1>
<?php
    $content = ob_get_clean();
    include 'Layout.php';
?>
