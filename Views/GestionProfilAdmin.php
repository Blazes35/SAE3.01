<?php
$title = 'Connection';
ob_start();
?>
    <link rel="stylesheet" href="css/gestionProfilAdmin.css">
    <div class="container">
        <h1 class="title">GESTION PROFILS</h1>
        <div class="search-bar">
            <input type="text" placeholder="Profil" class="search-input">
        </div>
        
    <?php
    echo $userAffiche;
    ?>
    </div>
<?php
$content = ob_get_clean();
include 'LayoutAdmin.php';
?>
