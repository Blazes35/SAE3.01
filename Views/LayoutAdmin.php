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
    </div>
    <div class="compte">
        <form id="myForm" method="POST" action="/~inf2pj02/">
            <input type="hidden" name="adminPanel" value="0">
            <a class="Administrer" href="" onclick="document.getElementById('myForm').submit(); return false; ">
                <span class="material-symbols-outlined">admin_panel_settings</span>
                <h4>ADMINISTRER</h4>
            </a>
        </form>
        <form id="myForm2" method="POST" action="/~inf2pj02/?page=Profil">
            <input type="hidden" name="adminPanel" value="0">
            <a href="" class="mon-compte" style="cursor: pointer;" onclick="document.getElementById('myForm2').submit(); return false;">
                <span class="material-symbols-outlined">account_circle</span>
                <div class="text-container">
                    <p>MON COMPTE</p>
                </div>
            </a>
            </form>
        
    </div>
    <div class="overlap-group">
        <div class="titre-de-page">
            <div class="overlap-group-3">
                <a href="/~inf2pj02?page=Dashboard" class="tableau" style="cursor: pointer;">TABLEAU DE BORD</a>
                <a href="/~inf2pj02/?page=Calendar" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                <a href="/~inf2pj02/?page=GestionProfilAdmin" class="profils" style="cursor: pointer;">GESTION PROFILS</a>
                <a href="/~inf2pj02/?page=Treasury" class="tresorie" style="cursor: pointer;">TRÉSORIE</a>
                <a href="" class="parametres" style="cursor: pointer;">PARAMÈTRES</a>
                <a href="/~inf2pj02/?page=Add" class="editer" style="cursor: pointer;">EDITER CONTENU</a>
            </div>
        </div>
    </div>
</div>
<?php echo $content?>
</body>
</html>