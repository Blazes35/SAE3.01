<?php
$title = 'Actualité';
ob_start();
?>
<link rel="stylesheet" href="css/news.css" />
            </div>
        </div>
    </div>
    <div class='titre'><h2>Actualité</h2></div>
    <?php echo $actuAff ?>
    </div>
<?php
$content = ob_get_clean();
include 'Layout.php';
?>