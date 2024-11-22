<?php 
require 'Controllers/SignUpController.php';
$controller = new SignUpController();
?>

<link rel="stylesheet" href="/css/inscription.css"/>


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
                        <option value="11C">11C</option>
                        <option value="11D">11D</option>
                        <option value="21A">21A</option>
                        <option value="21B">21B</option>
                        <option value="21C">21C</option>
                        <option value="21D">21D</option>
                        <option value="31A">31A</option>
                        <option value="31B">31B</option>
                        <option value="31C">31C</option>
                        <option value="31D">31D</option>
                    </select>
                </div>

                <!-- <div class="input-group">
                    <label for="pp"><span class="material-symbols-outlined">image </span></label>
                    <input type="file" name="pp" id="pp">
                </div> -->

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
<?php 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['SignUp'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $classe = htmlspecialchars($_POST['classe']);
        $mail = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        echo "<script>console.log(\"debug\",\"$nom\", \"$prenom\", \"$classe\", \"$mail\", \"$password\", \"$password2\");</script>";
        if ($password === $password2) {
            $controller->signUp($nom, $prenom, $classe, $mail, $password);
            header("Location: ?page=Login");
            exit();
        }else {
            echo "<script>alert(\"Les mots de passe ne correspondent pas\");</script>";
        }
    }
?>