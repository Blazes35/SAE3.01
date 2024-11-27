<?php
$title = 'Connection';
ob_start();
?>



    <link rel="stylesheet" href="../css/gestionProfilAdmin.css">

    <div class="container">
        <h1 class="title">GESTION PROFILS</h1>
        <div class="search-bar">
            <input type="text" placeholder="Profil" class="search-input">
        </div>
        

    <?php
    echo $userAffiche;
    ?>

    </div>
    <script>
            // Récupération des données de session envoyées depuis PHP
            var userRole = <?php echo json_encode($userRole); ?>;
            var userName = <?php echo json_encode($userName); ?>;

            // Affichage des informations dans la console
            console.log("Role de l'utilisateur : " + userRole);
            console.log("Nom de l'utilisateur : " + userName);

            // Tu peux également afficher d'autres informations sur la session si besoin
        </script>
<?php
$content = ob_get_clean();
include 'LayoutAdmin.php';
?>
