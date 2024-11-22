<?php 
    require 'Controllers/TreasuryController.php';
    $controller = new Treasury();

$chemin_dossier = "feuille_calcul/";

//Ajouter un fichier
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier_csv'])){
    $uploaded_file  = $_FILES['fichier_csv'];
    $uploaded_path = $chemin_dossier . basename($uploaded_file['name']);

    if(pathinfo($uploaded_path, PATHINFO_EXTENSION)==='csv'){
        move_uploaded_file($uploaded_file['tmp_name'], $uploaded_path);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}


//Supprimer un fichier
if(isset($_GET['supprimer'])){
    $fichier_a_suprimer = $chemin_dossier . $_GET['supprimer'];
    if(file_exists($fichier_a_suprimer)){
        unlink($fichier_a_suprimer);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

//Lecture des fichiers existant
$files = scandir($chemin_dossier);
$annees=[];
foreach($files as $file){
    if(preg_match('/vente(\d{4})\.csv/', $file, $matches)){
        $annees[] = $matches[1];
    }
}
rsort($annees);


$data = [];
$fichier_csv = "feuille_calcul/vente2023.csv";
if(file_exists($fichier_csv)){
    if(($handle = fopen($fichier_csv,"r"))!== FALSE){
        while(($row = fgetcsv($handle, 1000, ","))!==FALSE){
            $data[] = $row;
        }
        fclose($handle);
    }
}
?>


 <link rel="stylesheet" href="css/treasury.css"/>


<div class="tresoriecalcul">
    <div class="titretresorie">TRESORIE</div>
    <div class="dossier">
        <ul>
        <?php
        // Pour chaque année trouvée, créez un lien
        foreach ($annees as $annee) {
            $file_name = "vente".$annee.".csv";
            $url = $chemin_dossier . "\\vente" . $annee . ".csv";
            echo "<li>
            <span class='material-symbols-outlined'>file_save</span>
            <a href=\"$url\" target=\"_blank\">Vente de $annee</a>
            <a href=\"?supprimer=$file_name\" class=\"supprimer\">Supprimer</a>
            </li>";
        }
        ?>
        </ul>
        <form method="post" enctype="multipart/form-data">
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
