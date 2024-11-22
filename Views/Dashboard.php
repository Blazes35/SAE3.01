<?php 
    require 'Controllers/DashboardController.php';
    $controller = new Dashboard();
?>

<link rel="stylesheet" href="css/dashboard.css"/>

<div class="main-content">
    <h1 class="title">TABLEAU DE BORD</h1>
    <div class="container">
        <div class="card">
            <a href="?page=Dashboard" class="card-link">
                <div class="card-content">
                    <h2>Tableau de Bord</h2>
                    <span class="material-symbols-outlined">dashboard</span>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="calendrier.php" class="card-link">
                <div class="card-content">
                    <h2>Calendrier</h2>
                    <span class="material-symbols-outlined">calendar_today</span>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="GestionProfilAdmin.php" class="card-link">
                <div class="card-content">
                    <h2>Gestion Profils</h2>
                    <span class="material-symbols-outlined">group</span>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="?page=Treasury" class="card-link">
                <div class="card-content">
                    <h2>Trésorie</h2>
                    <span class="material-symbols-outlined">account_balance</span>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="parametres.html" class="card-link">
                <div class="card-content">
                    <h2>Paramètres</h2>
                    <span class="material-symbols-outlined">settings</span>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="/php/boutique_hugo.php" class="card-link">
                <div class="card-content">
                    <h2>Editer Contenu</h2>
                    <span class="material-symbols-outlined">edit</span>
                </div>
            </a>
        </div>
    </div>
</div>