<?php
    require_once 'Models/ConnectionModel.php';
    $model = new ConnectionModel();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updatePwd'])) {
        $email= htmlspecialchars($_SESSION['email']);    
        $oldpassword = htmlspecialchars($_POST['oldPassword']);
        $newPassword = htmlspecialchars($_POST['newPassword']);
        $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
        if($newPassword === $confirmPassword){
            if($model->changePwd($email, hash('sha256', $oldpassword), hash('sha256', $newPassword))){
                header("Location: /~inf2pj02/?page=Presentation");
                exit();            
            }else{
                echo "<script>alert(\"Ancien mot de passe incorrect\")</script>";
            }
        }
        else{
        echo "<script>alert(\"Nouveau mot de passe ne correspond pas à confirmation mot de passe\")</script>";
        }
    }
    require 'Views/UpdatePwd.php'
?>