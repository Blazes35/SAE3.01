<?php
$title = 'Profil';
ob_start();
?>
<link rel="stylesheet" href="./css/actu.css" />
            </div>
        </div>
    </div>
    <?php
    $connect = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
    
    $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
    $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité'; 

    
    $queryActu = "SELECT idActualite, titreActualite, descActualite, dateActualite, urlPhotoActualite FROM ACTUALITE"; 
    $launch = $connect->prepare($queryActu);
    $launch->execute();
    $actus = $launch->fetchAll(PDO::FETCH_ASSOC);

    echo "<div class='titre'><h2>Actualité</h2></div>";

    ?>

    <?php 
    foreach($actus as $actu):
    ?>
    <div class="container">
        <div class="actu-card">
            <div class="actu-card-in">
                <div class="actu-img">
                    <img src="uploads/actualites/<?php echo htmlspecialchars($actu['urlPhotoActualite']); ?>" 
                         alt="<?php echo htmlspecialchars($actu['titreActualite']); ?>" />
                </div>
                <div class="detail">
                    <p class="titre"><?php echo htmlspecialchars($actu['titreActualite']); ?></p>
                    <p class="contenu"><?php echo htmlspecialchars($actu['descActualite']); ?></p>
                    <p class="date"><?php echo htmlspecialchars($actu['dateActualite']); ?></p>
                    <?php
                    echo "<button><a href='detailActualite.php?id=" . urlencode($actu['idActualite']) . "' class='info'>Voir plus</button>"
                ?>
                    <?php 


                $userRole = isset($_SESSION['role']) ? (int)$_SESSION['role'] : 0;  // Conversion en entier
                $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité'; 

                if ($userRole === 3) { 
                    echo "<button class='settings'>";
                    echo " <a href='updateActu.php?id=" . urlencode($actu['idActualite']) . "'>";
                    echo " <span class='material-symbols-outlined'>settings</span>"; 
                    echo "<p id='probleme'>Parametrer</p>";
                    echo " </a>";
                    echo " </button>";
                }                
                ?>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>
    <script>
    // Récupération des données de session envoyées depuis PHP
    var userRole = <?php echo json_encode($userRole); ?>;
    var userName = <?php echo json_encode($userName); ?>;

    // Affichage des informations dans la console
    console.log("Role de l'utilisateur : " + userRole);
    console.log("Nom de l'utilisateur : " + userName);
    </script>
<?php
$content = ob_get_clean();
include 'Layout.php';
?>