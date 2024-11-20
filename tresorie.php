<?php
$chemin_dossier = "feuille_calcul/";

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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tresorie</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="gestionProfilAdmin.css" />
    <link rel="stylesheet" href="tresorie.css"/>
</head>
<body>

    <div class="menu">
    <div class="logo-theme">
        <img class="logo" src="./images/logo-sans-fond.png" />
        <div class="theme-claire">THEME CLAIRE</div>
    </div>
<div class="compte">
    <span class="material-symbols-outlined">account_circle</span>
    <a href="compte.html" class="mon-compte" style="cursor: pointer;">MON COMPTE</a>
</div>
<div class="overlap-group">
            <div class="titre-de-page">
                <div class="overlap-group-3">
                    <a href="tableau.html" class="tableau" style="cursor: pointer;">TABLEAU DE BORD</a>
                    <a href="calendrier.html" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                    <a href="profils.html" class="profils" style="cursor: pointer;">GESTION PROFILS</a>
                    <a href="tresorie.html" class="tresorie" style="cursor: pointer;">TRÉSORIE</a>
                    <a href="parametres.html" class="parametres" style="cursor: pointer;">PARAMÈTRES</a>
                    <a href="editer.html" class="editer" style="cursor: pointer;">EDITER CONTENU</a>
                </div>
        </div>
</div>
</div>

<div class="tresorie">
    <div class="titretresorie">TRESORIE</div>
    <div class="dossier">
        <ul>
        <?php
        // Pour chaque année trouvée, créez un lien
        foreach ($annees as $annee) {
            $url = $chemin_dossier . "\\vente" . $annee . ".csv";
            echo "<li><span class='material-symbols-outlined'>file_save</span><a href=\"$url\" target=\"_blank\">Vente de $annee</a></li>";
        }
        ?>

        </ul>
    </div>
    <div class="Feuillecalcul">
    <table border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <?php
            if (!empty($data)) {
                foreach ($data[0] as $header) {
                    echo "<th>" . htmlspecialchars($header) . "</th>";
                }
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        // Afficher les lignes suivantes comme contenu du tableau
        for ($i = 1; $i < count($data); $i++) {
            echo "<tr>";
            foreach ($data[$i] as $cell) {
                echo "<td>" . htmlspecialchars($cell) . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
    </div>
</div>
    
</body>
</html>