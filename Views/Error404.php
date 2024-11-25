<?php
$title = 'Page non trouvée';
// ob_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="css/layout.css">
        <!-- Lien pour importer les Material Icons -->
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<link rel="stylesheet" href="../css/error404.css"> <!-- Assurez-vous d'avoir un fichier CSS pour le style -->
        </div>
    </div>
</div>
<div class="error-container">
    <h1>404</h1>
    <p>Oups! La page que vous recherchez n'existe pas.</p>
    <a href="index.php?page=Accueil">Retour à l'accueil</a>
</div>

</body>
</html>
<?php
// $content = ob_get_clean();
// include 'Layout.php';
?>