<?php
require_once 'Models/mainModel.php';
$model = new MainModel();

$chemin_dossier = "feuille_calcul/";

//Ajouter un fichier
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fichier_csv'])){
    $uploaded_file  = $_FILES['fichier_csv'];
    $uploaded_path = $chemin_dossier . basename($uploaded_file['name']);

    if(pathinfo($uploaded_path, PATHINFO_EXTENSION)==='csv'){
        move_uploaded_file($uploaded_file['tmp_name'], $uploaded_path);
    }
    header("Location: ?page=Treasury");
    exit();
}


//Supprimer un fichier
if(isset($_GET['supprimer'])){
    $fichier_a_suprimer = $chemin_dossier . $_GET['supprimer'];
    if(file_exists($fichier_a_suprimer)){
        unlink($fichier_a_suprimer);
    }
    header("Location: ?page=Treasury");
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

require 'Views/Treasury.php';
?>