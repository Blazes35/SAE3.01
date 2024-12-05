<?php
$title = 'Changement Mot De Passe';
ob_start();
?>

<link rel="stylesheet" href="css/updatepwd.css"/>

        </div>
    </div>
</div>
<div class="changement">
    <div class="titrechangement">CHANGER VOTRE MOT DE PASSE</div>
    <div class="formulaire">
        <form action="?page=UpdatePwd" method="post">
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
$content = ob_get_clean();
include 'Layout.php';
?>