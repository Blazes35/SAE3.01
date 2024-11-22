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
                    <label for="oldPassword ">
                        <span class="material-symbols-outlined">lock</span>
                    </label>
                    <input type="password" id="oldPassword" name="oldPassword" placeholder="ANCIEN MOT DE PASSE" required>
                </div>
                <div class="input-group">
                    <label for="newPassword">
                        <span class="material-symbols-outlined">lock</span>
                    </label>
                    <input type="password" id="newPassword" name="newPassword" placeholder="NOUVEAU MOT DE PASSE" required>
                </div>

                <div class="input-group">
                    <label for="confirmPassword">
                        <span class="material-symbols-outlined">lock</span>
                    </label>
                    <input type="password" id="confirmPassword" name="confirmPassword" placeholder="CONFIRMER MOT DE PASSE" required>
                </div>
                
                <div class="envoyer">
                    <button type="submit" name='updatePwd'>CONFIRMER</button>
                </div>
            </form>
        </div>
    </div>
    <div>
        <img class="imagefooter" src="images/ellipse4.png">
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePwd'])) {
        $email= htmlspecialchars($_SESSION['email']);    
        $oldpassword = htmlspecialchars($_POST['oldPassword']);
        $newPassword = htmlspecialchars($_POST['newPassword']);
        $confirmPassword = htmlspecialchars($_POST['confirmPassword']);

        if($newPassword === $confirmPassword){
            
            if($controller->changePwd($email, hash('sha256', $oldpassword), hash('sha256', $newPassword))){
                header("Location: ?page=Presentation");
                exit();            }
            else{
                echo "<script>alert(\"Ancien mot de passe incorrect\")</script>";
            }
        }
        else{
        echo "<script>alert(\"Nouveau mot de passe ne correspond pas à confirmation mot de passe\")</script>";
        // header("Location: ?page=Login");
        // exit();
        }
    }
    ?>