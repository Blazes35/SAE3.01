<?php
$title = "Accueil";
ob_start();

// Connexion à la base de données
try {
    $pdo = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Requête pour récupérer les actualités
$query = "SELECT idActualite, titreActualite, urlPhotoActualite FROM ACTUALITE ORDER BY dateActualite DESC LIMIT 4";
$stmt = $pdo->query($query);
$actualites = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<link rel="stylesheet" href="css/accueil.css"/>
<div class = boxaccueil>
<div class="top">
<div class="overlap-group-4accueil">
                    <div>ADIIL</div>
                    <div class="ligneaccueil"></div>
                    <div class="bde-informatique-lavalaccueil">BDE INFORMATIQUE<br> DE LAVAL</div>
                    <button class="decouvrer-nous" onclick="window.location.href='presentation.html';">
                        <span>DÉCOUVRE NOUS !</span>
                        <div class="border decouvrer-nous"></div>
                    </button>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
    


<div class="box2accueil" onclick="actu.php">
    <a href="actu.php" class="titre-link">
        <div class="titre">ACTUALITÉ</div>
    </a>
    <div class="group1">
        <div class="bureauetu">Nouveau Bureau Des Étudiants !</div>
        <!--Début du carrousel-->
        <div class="wrapper">
            <div class="conterner">
                <?php foreach ($actualites as $index => $actu): ?>
                    <input type="radio" name="slide" id="c<?= $index + 1 ?>" <?= $index === 0 ? 'checked' : '' ?> />
                    <label for="c<?= $index + 1 ?>" class="card">
                        <img class="image" src="uploads/actualites/<?= htmlspecialchars($actu['urlPhotoActualite']) ?>" alt="<?= htmlspecialchars($actu['titreActualite']) ?>">
                        <div class="row">
                            <div class="icon"><?= $index + 1 ?></div>
                            <div class="description">
                                <h4><?= htmlspecialchars($actu['titreActualite']) ?></h4>
                            </div>
                        </div>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
    
    <div class="box3accueil">
        <div class="titregrade">
            NOS GRADES
        </div>
        <div class="grade">
            <div class="diamant">
                <img class="imagediamant" src="images/diamant1.png" alt="grade diamant">
                <div class="titrediamant">GRADE DIAMANT</div>
                <div class="avantage">AVANTAGES</div>
                <div class="avangrade">
                <ul>
                    <li>AVANTAGES GOLDS</li>
                    <li>-10% SUR TOUS LES ÉVÉNEMENTS DU BDE</li>
                    <li>VALABLE TOUTE L'ANNÉE</li>
                    <li>1 BON D'ACHAT DE 10€ SUR L'ENTIÈRETÉ DE LA BOUTIQUE</li>
                </ul>
                </div>
                <div class="prix">13€</div>
            </div>
            <div class="or">
                <img class="imageor" src="images/lingot_d_or1.png" alt="grade or">
                <div class="titreor">GRADE OR</div>
                <div class="avantage">AVANTAGES</div>
                <div class="avangrade">
                <ul>
                    <li>AVANTAGES IRON</li>
                    <li>ÉVÉNEMENT PRIVÉS</li>
                    <li>SOIRÉES PRIVÉES DU BDE</li>
                </ul>
                </div>
                <div class="prix">10€</div>
            </div>
            <div class="fer">
                <img class="imagefer" src="images/lingot_de_fer1.png" alt="grade fer">
                <div class="titrefer">GRADE FER</div>
                <div class="avantage">AVANTAGES</div>
                <div class="avangrade">
                    <ul>
                        <li>COMPETITIONS DE CODE</li>
                        <li>ACCÈS AU BÉNÉFICE DU PARRAINAGE(BONUS D'EXP)</li>
                    </ul>
                </div>
                <div class="prix">5€</div>

            </div>
        </div>
    </div>
    <div class="box4accueil">
        <div class="classement">
            <div class="titreclassement">CLASSEMENT</div>
            <div class="podium">
                <div class="premier">
                    <div class="num">
                        1
                    </div>
                    <div class="pseudo">
                        PSEUDO1
                    </div>
                </div>
                <div class="deuxieme">
                    <div class="num">
                        2
                    </div>
                    <div class="pseudo">
                        PSEUDO2
                    </div>
                </div>
                <div class="troisieme">
                    <div class="num">
                        1
                    </div>
                    <div class="pseudo">
                        PSEUDO2
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box5accueil">
        <div class="eventtitrevenir">ÉVÉNEMENT À VENIR</div>
        <div class="eventvenir">
            <div class="eventtext">
                <div class="titreevent">KARTING</div>
                <div class="description">VENEZ VIVRE l'ÉXPÉRIENCE D'UN PILOTE SUR LE CIRCUIT DE BEAUSOLEIL À LAVAL </div>
                <a  class="inscription" href="evenement.html">INSCRIS TOI</a>
            </div>
            <div class="image">
                <img class="imagekart" src="images/karting1.png" alt="photo de karting">
            </div>
        </div>
    </div>
    <div class="box-5">
    <div class="rejoins-nous">REJOINS-NOUS</div>
        <button class="button-inscription">INSCRIPTION</button>
    </div>



<?php
$content = ob_get_clean();
include 'Layout.php';
?>