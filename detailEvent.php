<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évenement</title>
    <!-- Lien pour importer les Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="./css/detailEvent.css" />
    <link rel="stylesheet" href="header.css" />
    <link rel="icon" href=".images/favicon.ico" type="image/x-icon" /> <!-- Ajoutez cette ligne -->
    <script src="https://www.paypal.com/sdk/js?client-id=AYKrl7Ba9EH0Y6g6vrEQgMziTW3mhT8K2bFHokW6IF-PopEIdcArlJ_Oh__hUWF5GjbNIqNLBDD_T-YT&currency=EUR"></script>
    </head>
<body>
    <header>
        <div class="overlap-group">
            <img class="logo" src="../images/logo.png" />
            <div class="theme-claire">THEME CLAIRE</div>
        </div>
        <div class="overlap-group-2">
            <span class="material-symbols-outlined">account_circle</span>
            <div class="mon-compte">MON COMPTE</div>
            <span class="material-symbols-outlined">shopping_cart</span>
        </div>
    </header>
    <div class="box">
        <div class="rectangle">
            <div class="titre-de-page">
                <div class="overlap-group-3">
                    <a href="presentation.html" class="presentation" style="cursor: pointer;">QUI SOMMES NOUS</a>
                    <a href="evenement.html" class="evenement" style="cursor: pointer;">ÉVENEMENTS</a>
                    <a href="calendrier.html" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                    <a href="galerie.html" class="galerie" style="cursor: pointer;">GALERIE</a>
                    <a href="boutique.html" class="boutique" style="cursor: pointer;">BOUTIQUE</a>
                </div>
            </div>
        </div>
    </div>
    <?php 
    $sql = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');


    session_name('BDE');
        session_set_cookie_params(86400 * 30, "/");
        session_start();

       
        $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
        $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité'; 

    if (isset($_GET['id'])) {
        $idEvent = intval($_GET['id']);
        $query = "SELECT * FROM EVENEMENT WHERE idEvent = :id";
        $stmt = $sql->prepare($query);
        $stmt->bindParam(':id', $idEvent, PDO::PARAM_INT);
        $stmt->execute();

        if ($event = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $uploadDir = 'uploads/evenements/';

            echo "<div class='container'>";
                echo "<div class='titre'><h2>Inscription</h2></div>";
                echo "<div class='image-gallery'>";
                    echo "<div class='first-img'>";
                        echo "<img src='" . htmlspecialchars($uploadDir . $event['imgEvent']) . "' alt='" . htmlspecialchars($event['titreEvent']) . "' />";
                    echo "</div>";
                echo "</div>";

                echo "<div class='event-details'>";
                    echo "<h1 class='event-title'>" . htmlspecialchars($event['titreEvent']) . "</h1>";
                    echo "<p class='description'>" . htmlspecialchars($event['descEvent']) . "</p>";
                    echo "<p class='capacite'>Capacité : " . htmlspecialchars($event['capaEvent'])."</p>";
                    echo "<p class='lieu'>Lieu : " . htmlspecialchars($event['lieuEvent'])."</p>";
                    echo "<p class='date'>Date : " . htmlspecialchars($event['dateEvent']). "</p>";
                    echo "<p class='price'>" . htmlspecialchars($event['prixEvent']) . " €</p>";
                    echo "</div>";
                echo "<div class='boutons'>";
                if($userRole === "3"){
                    echo "<a href='updateEvent.php?id=".urlencode($event['idEvent']) . "'><button class='param'>Paramétrer</button></a>";
                }
                echo "<div id='paypal-button-container'></div>";
                echo "</div>";
            } else {
            echo "<p>Événement introuvable.</p>";
        }
    } else {
        echo "<p>Paramètre invalide.</p>";
    }
    echo "</div>";
    ?>
     <script>
            // Récupération des données de session envoyées depuis PHP
            var userRole = <?php echo json_encode($userRole); ?>;
            var userName = <?php echo json_encode($userName); ?>;

            // Affichage des informations dans la console
            console.log("Role de l'utilisateur : " + userRole);
            console.log("Nom de l'utilisateur : " + userName);

            paypal.Buttons({
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '<?php echo $event['prixEvent']; ?>'
                }
            }]
        });
    },
    onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
            alert('Transaction completed by ' + details.payer.name.given_name);
            window.location.href = 'inscription.php?id=<?php echo urlencode($event['idEvent']); ?>';
        });
    }
}).render('#paypal-button-container').catch(function(err) {
    console.error("Erreur lors du rendu PayPal :", err);
});
</script>
</body>
</html>
