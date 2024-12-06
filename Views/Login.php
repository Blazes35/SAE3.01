<?php
$title = 'Connection';
ob_start();
?>

<link rel="stylesheet" href="css/login.css"/>
        </div>
    </div>
</div>
<link rel="stylesheet" href="css/login.css"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
<div class="connexion">
    <div class="titreconnexion">CONNEXION</div>
    <div class="formulaire">
        <form action="?page=Login" method="post">
            <div class="input-group">
                <label for="email">
                    <span class="material-symbols-outlined">person</span>
                </label>
                <input type="email" id="email" name="email" placeholder="EMAIL" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
            </div>
            <div class="input-group">
                <label for="password">
                    <span class="material-symbols-outlined">lock</span>
                </label>
                <input type="password" id="password" name="password" placeholder="MOT DE PASSE" required>
            </div>
            <a class="mdpoubli" href="?page=UpdatePwd">Mot de passe oublié ?</a>
            <div class="envoyer">
                <button type="submit" name="connect">SE CONNECTER</button>
            </div>
        </form>
        <div class="inscri">
            VOUS ETES NOUVEAU ?
                <a class="inscription" href="?page=SignUp">INSCRIVEZ-VOUS !</a>
        </div>
    </div>
</div>
<div>
    <img class="imagefooter" src="images/ellipse4.png">
</div>

<?php
$content = ob_get_clean();
include 'Layout.php';
?>