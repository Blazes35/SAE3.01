<?php

include 'functions.php';
$connection = connectToDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    echo login($connection, $username, $password);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../globals.css" />
    <link rel="stylesheet" href="../header.css"/>
    <link rel="stylesheet" href="../Views/login.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>
<body>
<header>
        <div class="overlap-group">
            <img class="logo" src="../images/logo.png" />
            <div class="theme-claire">THEME CLAIRE</div>
            
        </div>
        <div class="overlap-group-2">
            <span class="material-symbols-outlined">account_circle</span>
            <div class="mon-compte">MON COMPTE</div>
            <span class="material-symbols-outlined">shopping_cart</span>
        </div>
    </header>
    <div class="connexion">
        <div class="titreconnexion">CONNEXION</div>
        <div class="formulaire">
            <form action="login.php" method="post">
                <div class="identifiant"></div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="mdp">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <a class="mdpoubli" href="motpassoublie.html">Mot de passe oublié ?</a>
                <div class="envoyer">
                    <button type="submit">Login</button>
                </div>
            </form>
            <div class="inscri
        </div>
    </div>
    <footer>
        <!--<img class="imagefooter" src="../images/ellipse4.png">-->
    </footer>
</body>
</html>