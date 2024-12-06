<?php
require_once 'Models/ConnectionModel.php';
$model = new ConnectionModel();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['connect'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if ($model->login($email, $password)) {
        header("Location: ?page=");
        exit();
    }else{
        echo "<script>alert(\"Identifiants incorrects\")</script>";
    }
}

require 'Views/Login.php';
?>