<?php
    require_once 'Models/ConnectionModel.php';
    $model = new ConnectionModel();    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['SignUp'])) {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $classe = htmlspecialchars($_POST['classe']);
        $mail = htmlspecialchars($_POST['mail']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        if ($password === $password2) {
            $model->createUser($nom, $prenom, $classe, $mail, $password);
            header("Location: ?page=Login");
            exit();
        }else {
            echo "<script>alert(\"Les mots de passe ne correspondent pas\");</script>";
        }
    }

    require 'Views/SignUp.php';
?>