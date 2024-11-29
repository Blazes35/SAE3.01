<?php
$title = 'Page non trouvée';
ob_start();
?>
<link rel="stylesheet" href="css/error404.css"> <!-- Assurez-vous d'avoir un fichier CSS pour le style -->
        </div>
    </div>
</div>
<div class="error-container">
    <h1>404</h1>
    <p>Oups! La page que vous recherchez n'existe pas.</p>
    <a href="index.php?page=Accueil">Retour à l'accueil</a>
</div>
<?php
$content = ob_get_clean();
include 'Layout.php';
?>