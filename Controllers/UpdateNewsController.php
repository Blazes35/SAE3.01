<?php
require 'Models/UpdateNewsModel.php';
$model = new UpdateNewsModel();
$connect = $model->getDB();


$message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update' && isset($_POST['idActualite'])) {
        $idActualite = intval($_POST['idActualite']);
        $titreActualite = $_POST['titreActualite'];
        $descActualite = $_POST['descActualite'];
        $dateActualite = $_POST['dateActualite'];
        $imgActualite = $_POST['currentImg']; // Valeur par défaut
        $model->updateNews($idActualite, $titreActualite, $descActualite, $dateActualite, $imgActualite);
        $_SESSION['adminPanel'] = 0;
        header('Location: /?page=News');
    } elseif ($_POST['action'] === 'delete' && isset($_POST['idActualite'])) {
        // Suppression de l'actualité
        $idActualite = intval($_POST['idActualite']);
        $model->deleteNews($idActualite);
        $_SESSION['adminPanel'] = 0;
        header('Location: /?page=News');
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $idActualite = intval($_POST['idActualite']);
    $actu = $model->getNews($idActualite);
} else {
    echo "<p>Aucun ID fourni.</p>";
}
require 'Views/UpdateNews.php';