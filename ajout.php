
<?php
session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test ajout produit</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
    <div class="menu">
        <div class="logo-theme">
            <img class="logo" src="./images/logo-sans-fond.png" />
            <div class="theme-claire">THEME CLAIRE</div>
        </div>
        <div class="compte">
            <span class="material-symbols-outlined">account_circle</span>
            <a href="compte.html" class="mon-compte" style="cursor: pointer;">MON COMPTE</a>
        </div>
        <div class="overlap-group">
            <div class="titre-de-page">
                <div class="overlap-group-3">
                <a href="TableauBord.html" class="tableau" style="cursor: pointer;">TABLEAU DE BORD</a>
                    <a href="calendrier.php" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                    <a href="GestionProfilAdmin.php" class="profils" style="cursor: pointer;">GESTION PROFILS</a>
                    <a href="tresorie.php" class="tresorie" style="cursor: pointer;">TRÉSORIE</a>
                    <a href="parametres.html" class="parametres" style="cursor: pointer;">PARAMÈTRES</a>
                    <a href="ajout.php" class="editer" style="cursor: pointer;">EDITER CONTENU</a>
                </div>
            </div>
        </div>
    </div>


</head>
<body>
    <?php
    
<script>
            var userRole = <?php echo json_encode($userRole); ?>;
            var userName = <?php echo json_encode($userName); ?>;
            var userId = <?php echo json_encode($idUser); ?>;

            console.log("Role de l'utilisateur : " + userRole);
            console.log("Nom de l'utilisateur : " + userName);
            console.log("Id de l'utilisateur : " + userId);
s        </script>
</body>
</html>
