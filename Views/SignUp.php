<?php
$title = 'Profil';
ob_start();
?>
<link rel="stylesheet" href="css/signup.css"/>
        </div>
    </div>
</div>
<div class="inscription">
    <div class="titreinscription">INSCRIPTION</div>
        <div class="formulaire">
            <form action="?page=SignUp" method="post">
                <div class="input-group">
                    <label for="nom">
                        <span class="material-symbols-outlined">person</span>
                    </label>
                    <input type="text" id="nom" name="nom" placeholder="NOM" value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="prenom">
                        <span class="material-symbols-outlined">person</span>
                    </label>
                    <input type="text" id="prenom" name="prenom" placeholder="PRÉNOM" value="<?php echo isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : ''; ?>" required>
                </div>

                <div class="input-group">
                    <label for="mail">
                        <span class="material-symbols-outlined">mail</span>
                    </label>
                    <input type="email" id="mail" name="mail" placeholder="EMAIL" value="<?php echo isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : ''; ?>" required>
                </div>

                <div class="select-group">
                    <label for="classe">
                        <span class="material-symbols-outlined">school</span>
                    </label>
                    <select id="classe" name="classe" required>
                        <option value="" disabled selected>Choisissez votre classe</option>
                        <option value="11A">11A</option>
                        <option value="11B">11B</option>
                        <option value="12C">12C</option>
                        <option value="12D">12D</option>
                        <option value="21A">21A</option>
                        <option value="21B">21B</option>
                        <option value="22C">22C</option>
                        <option value="22D">22D</option>
                        <option value="31A">31A</option>
                        <option value="31B">31B</option>
                        <option value="32C">32C</option>
                        <option value="32D">32D</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="password">
                        <span class="material-symbols-outlined">lock</span>
                    </label>
                    <input type="password" id="password" name="password" placeholder="MOT DE PASSE" required>
                </div>
                <div class="input-group">
                    <label for="confirm password">
                        <span class="material-symbols-outlined">lock</span>
                    </label>
                    <input type="password" id="password2" name="password2" placeholder="CONFIRMATION MOT DE PASSE" required>
                </div>

                <div class="envoyer">
                    <button type="submit" name="SignUp" name>S'INSCRIRE</button>
                </div>
            </form>
        </div>
        <img class="imagefooter" src="images/ellipse4.png">
    </div>
</div>
<?php
$content = ob_get_clean();
include 'Layout.php';
?>