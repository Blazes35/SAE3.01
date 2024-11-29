
<?php 
$title = 'Treasury';
ob_start();
?>
<link rel="stylesheet" href="css/treasury.css"/>
<div class="tresoriecalcul">
    <div class="titretresorie">TRESORIE</div>
    <div class="dossier">
        <ul>
        <?php
        // Pour chaque année trouvée, créez un lien
            echo $affichCsv;
        ?>
        </ul>
        <form id="upload" method="post" enctype="multipart/form-data">
            <div class="import">
                <label for="fichier_csv"> Sélectionner csv</label>
                <input type="file" id="fichier_csv" name = "fichier_csv" accept=".csv" required/>
            </div>
            <div class="confirm">
                <button type="submit">Ajouter</button>
            </div>
        </form>
    </div>
    <div class="Feuillecalcul"> 
        <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vTRA4kGY_qUwJL95Ewt9b2XWpHdRl43_qPnTifZ0gyMRSfRQHLX1LhBjGRZ-Fi9QANd3vYEBJA3lsRP/pubhtml?gid=1565703647&amp;single=true&amp;widget=true&amp;headers=false"></iframe>
        <a href="https://docs.google.com/spreadsheets/d/1FngDpYU9gaINMVpy378ttvsUlhEGoRikUBvL3_8XPLI/edit?usp=sharing">Modifier</a>
    </div>
</div>
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
include 'LayoutAdmin.php';
?>