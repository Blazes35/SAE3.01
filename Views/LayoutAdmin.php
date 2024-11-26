<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="css/layoutadmin.css">
</head>
<body>
<div class="menu">
    <div class="logo-theme">
        <img class="logo" src="images/logo-sans-fond.png" />
        <div class="theme-claire">THEME CLAIRE</div>
    </div>
<div class="compte">
    <span class="material-symbols-outlined">account_circle</span>
    <a href="compte.html" class="mon-compte" style="cursor: pointer;">MON COMPTE</a>
</div>
<div class="overlap-group">
            <div class="titre-de-page">
                <div class="overlap-group-3">
                    <a href="?page=Dashboard" class="tableau" style="cursor: pointer;">TABLEAU DE BORD</a>
                    <a href="calendrier.php" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                    <a href="GestionProfilAdmin.php" class="profils" style="cursor: pointer;">GESTION PROFILS</a>
                    <a href="?page=Treasury" class="tresorie" style="cursor: pointer;">TRÉSORIE</a>
                    <a href="parametres.html" class="parametres" style="cursor: pointer;">PARAMÈTRES</a>
                    <a href="boutique_hugo.php" class="editer" style="cursor: pointer;">EDITER CONTENU</a>
                </div>
        </div>
</div>
</div>
<?php echo isset($content) ? $content : '';?>
</body>
</html>