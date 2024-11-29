<?php
$title = 'Profil';
ob_start();
?>

<link rel="stylesheet" href="css/profil.css"/>
        </div>
    </div>
</div>

<div class="profile">
    <div class="titreProfil">
        <p>Page Personnelle</p>
    </div>
    <div class="haut">
    <div class="info">
        <div class= 'prengrade'>
        <div class="prenomnom">
            <?php   echo "<p>" . $_SESSION['nom'] . " " . $_SESSION['prenom'] . "</p>";  ?>
        </div>
        <?php
        if (isset ($_SESSION['grade'])){
            echo '<div class="grade">';
            switch ($_SESSION['grade']) {
                case 1: echo '<img src="images/lingot_de_fer1.png"/>'; break;
                case 2: echo '<img src="images/lingot_d_or1.png"/>'; break;
                case 3: echo '<img src="images/diamant1.png"/>'; break;
            }
            echo '</div>';
        }
        
        ?>
        </div>
        <div class="role">
            
        </div>
    </div>
    <div class="bouton">
        <div class="changemdp">
            <a href="?page=UpdatePwd">
                <button type="button">Modifier votre mot de passe</button>
            </a>
        </div>
    </div>
</div>
    <form action="/?page=Profil" method="post">
    <div class="input-group">
        <label for="changeNom">
            Nom
        </label>
        <input type="text" id="nom" name="nom" value="<?php echo $_SESSION['nom'];?>">
    </div>

    <div class="input-group">
        <label for="changePrenom">
            Prénom
        </label>
        <input type="text" id="prenom" name="prenom" value="<?php echo $_SESSION['prenom'];?>">
    </div>

    <div class="input-group">
        <label for="changmail">
            Email
        </label>
        <input type="email" id="mail" name="mail" value="<?php echo $_SESSION['email']?>">
    </div>

    <div class="envoyer">
        <button type="submit" name="validate">MODIFIER</button>
    </div>
    </form>
    <div class =event>
        <div class="titreEvent">
            Evénement Réalisé
        </div>
        <div class="afficheevent">
        <?php
            echo $eventAff;
        ?>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'Layout.php';
?>