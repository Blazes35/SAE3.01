<?php
$title = "Accueil";
ob_start();
?>
<link rel="stylesheet" href="css/accueil.css"/>
<div class = boxaccueil>
<div class="top">
<div class="overlap-group-4accueil">
                    <div>ADIIL</div>
                    <div class="ligneaccueil"></div>
                    <div class="bde-informatique-lavalaccueil">BDE INFORMATIQUE<br> DE LAVAL</div>
                    <button class="decouvrer-nous" onclick="window.location.href='?page=Presentation';">
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
    <div class="titre">ACTUALITÉ</div>
    <div class="bureauetu">Nouveau Bureau Des Étudiants !</div>
    <div class="group1">
    <!--Début du carrousel-->
    <div class="wrapper">
        <div class="conterner">
            <?php 
            $actualitesLimite = array_slice($actualites, 0, 4); // Limite à 4 éléments
            foreach ($actualitesLimite as $index => $actu): ?>
                <input type="radio" name="slide" id="c<?= $index + 1 ?>" <?= $index === 0 ? 'checked' : '' ?> />
                <label for="c<?= $index + 1 ?>" class="card">
                    <img class="image" src="uploads/actu/<?= htmlspecialchars($actu['urlPhotoActualite']) ?>" alt="<?= htmlspecialchars($actu['titreActualite']) ?>">
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
<a href="?page=News" class="titre-link">
        <div class="voir-plus">Voir plus</div>
</a>
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
                <form method="POST" action="?page=HaveGuard" class="price-button-form">
                    <button type="submit" name="priceSelected" value="3" class="prix-button">15€</button>
                </form>
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
                <form method="POST" action="?page=HaveGuard" class="price-button-form">
                    <button type="submit" name="priceSelected" value="2" class="prix-button">10€</button>
                </form>
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
                <form method="POST" action="?page=HaveGuard" class="price-button-form">
                    <button type="submit" name="priceSelected" value="1" class="prix-button">5€</button>
                </form>
            </div>
        </div>
    </div>

<?php
if(!isset($_SESSION['id'])){
    echo $rejoinsNous ;
}

$content = ob_get_clean();
include 'Layout.php';
?>