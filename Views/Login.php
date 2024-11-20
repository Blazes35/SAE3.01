<?php 
require 'Controllers/loginController.php';
$controller = new loginController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connect'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    echo "<script>console.log(\"debug\",\"$username\", \"$password\");</script>";
    echo "<script>console.log(\"debug\", \"{$controller->login($username, $password)}\");</script>";
    if (!$controller->login($username, $password)) {
        echo "<script>console.log(\"debug\", \"{$controller->login($username, $password)}\");</script>";
    }
}
?>

<!-- Link to the CSS file -->
<link rel="stylesheet" href="css/login.css"> 
<!-- Display the layout -->
<?php echo $controller->renderLayout(); ?>
<!-- The following code is the layout of the website -->
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="../css/login.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <div class="connexion">
        <div class="titreconnexion">CONNEXION</div>
        <div class="formulaire">
            <form action="" method="post" onsubmit="this.action='?page=Login&username=' + encodeURIComponent(this.username.value) + '&password=' + encodeURIComponent(this.password.value);">
                <div class="input-group">
                    <label for="username">
                        <span class="material-symbols-outlined">person</span>
                    </label>
                    <input type="email" id="username" name="username" placeholder="EMAIL" required>
                </div>
                <div class="input-group">
                    <label for="password">
                        <span class="material-symbols-outlined">lock</span>
                    </label>
                    <input type="password" id="password" name="password" placeholder="MOT DE PASSE" required>
                </div>
                <a class="mdpoubli" href="motpassoublie.html">Mot de passe oublié ?</a>
                <div class="envoyer">
                    <button type="submit" name="connect">SE CONNECTER</button>
                </div>
            </form>
            <div class="inscri">
                VOUS ETES NOUVEAU ?
                <a class="inscription" href="inscription.html">INSCRIVEZ-VOUS !</a>
            </div>
        </div>
    </div>
    <div>
        <img class="imagefooter" src="../images/ellipse4.png">
    </div>