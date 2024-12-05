<?php
$title = 'Grade';
ob_start();
?>

<link rel="stylesheet" href="css/haveGrade.css" />

        </div>
    </div>  
</div>

<div class="grade">
    <?php echo $gradeAff;?>
    <div class="bouton">
    <form action="?page=" method="get">
        <button type="submit">Retourner à l'accueil</button>
    </form>
    </div>
</div>
<?php
$content = ob_get_clean();
include 'Layout.php';
?>