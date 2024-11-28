
    <link rel="stylesheet" href="../css/inscription.css">


    <div class="container">
        <h1>Inscription à l'événement</h1>
        <p><?php echo $message; ?></p>
    </div>

<script>
    // Récupération des données de session envoyées depuis PHP
    var userRole = <?php echo json_encode($userRole); ?>;
    var userName = <?php echo json_encode($userName); ?>;

    // Affichage des informations dans la console
    console.log("Role de l'utilisateur : " + userRole);
    console.log("Nom de l'utilisateur : " + userName);
</script>


</body>
</html>
