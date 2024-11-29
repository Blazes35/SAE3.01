<?php
$title = 'Grade';
ob_start();
?>

<link rel="stylesheet" href="css/haveGuard.css" />

        </div>
    </div>  
</div>

<?php echo var_dump($_SESSION);?>
<div class="grade">
    <?php echo $gradeAff;?>
    <div class="bouton">
    <form action="/" method="get">
        <button type="submit">Retourner à l'accueil</button>
    </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'Layout.php';
?>