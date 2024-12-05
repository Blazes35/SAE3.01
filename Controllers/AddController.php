<?php 
require_once 'Models/AddModel.php';
$model = new AddModel();



$idUser = $_SESSION['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null; 
    $type = $_POST['article'] ?? '';
    $title = $_POST['title'] ?? '';

    if ($action === 'add') {
        $model->addArticle($_POST, $_FILES['picture']);
    } elseif ($action === 'delete') {
        if (!empty($type) && !empty($title)) {
            $model->deleteArticle($type, $title);
        } else {
            echo "Veuillez sélectionner un type d'article et fournir un titre.";
        }
    }
}

require 'Views/Add.php';
