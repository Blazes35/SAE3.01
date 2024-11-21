<?php 
require 'Controllers/UpdatepwdController.php';
$controller = new Updatepwd();
?>

<link rel="stylesheet" href="/css/updatepwd.css"/>

</div>
</div>
</div>

<div class="changement">
        <div class="titrechangement">CHANGER VOTRE MOT DE PASSE</div>
        <div class="formulaire">
            <form action="" method="post" onsubmit = "this.action='?page=Updatepwd&oldpassword=' + encodeURIComponent(this.oldpassword.value) + '&newpassword=' + encodeURIComponent(this.newpassword.value) +'&confirmpassword='+encodeURIComponent(this.confirmpassword.value)'">
                <div class="input-group">
                    <label for="username">
                        <span class="material-symbols-outlined">lock</span>
                    </label>
                    <input type="password" id="oldpassword" name="oldpassword" placeholder="ANCIEN MOT DE PASSE" required>
                </div>
                <div class="input-group">
                    <label for="newpassword">
                        <span class="material-symbols-outlined">lock</span>
                    </label>
                    <input type="password" id="newpassword" name="newpassword" placeholder="NOUVEAU MOT DE PASSE" required>
                </div>

                <div class="input-group">
                    <label for="confirmpassword">
                        <span class="material-symbols-outlined">lock</span>
                    </label>
                    <input type="password" id="confirmpassword" name="confirmpassword" placeholder="CONFIRMER MOT DE PASSE" required>
                </div>
                
                <div class="envoyer">
                    <button type="submit" name='updayePwd'>CONFIRMER</button>
                </div>
            </form>
        </div>
    </div>
    <div>
        <img class="imagefooter" src="images/ellipse4.png">
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePwd'])) {
    $username = htmlspecialchars($_POST['oldpassword']);
    $password = htmlspecialchars($_POST['newpassword']);
    $passwordconfirm = htmlspecialchars($_POST['confirmpassword']);

        if(password === $passwordconfirm){
            $controller->changePwd($username, $password);
            header("Location: ?page=Presentation");
            exit();
        }
        else{
        echo "<script>alert(\"Nouveau mot de passe ne correspond pas à confirmation mot de passe\")</script>";
        // header("Location: ?page=Login");
        // exit();
        }
    }
    ?>