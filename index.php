<?php
session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();
$_SESSION['adminPanel'] = isset($_SESSION['adminPanel']) ? $_SESSION['adminPanel'] : 0;
$role =  isset($_SESSION['role']) ? $_SESSION['role'] : 5;

// routage
if (!$_SESSION['adminPanel']){
    $page = $_POST['page'] ?? isset($_GET['page']) && $_GET['page'] != '' ? $_GET['page'] : 'Accueil';
    switch ($page) {
        case 'Accueil':
            include './Controllers/AccueilController.php';
            break;
        case 'Presentation':
            include './Controllers/PresentationController.php';
            break;
        case 'Profil':
            include './Controllers/ProfilController.php';
            break;
        case 'Login':
            include './Controllers/LoginController.php';
            break;
        case 'SignUp':
            include './Controllers/SignUpController.php';
            break;
        case 'UpdatePwd':
            include './Controllers/UpdatePwdController.php';
            break;
        case 'Galerie':
            include './Controllers/GalerieController.php';
            break;
        case 'Actu':
            include './Controllers/ActuController.php';
            break;
        case 'Shop' :
            include './Controllers/ShopController.php';
            break;
        case 'Basket' :
            include './Controllers/BasketController.php';
            break;
        case 'Event' :
            include "./event.php";
            break;
        case 'DetailProduct' :
            include "./Controllers/DetailProductController.php";
            break;
        case 'News' : 
            include "./actu.php";
            break;
        default:
            include './Views/Error404.php';
            break;
    }
}else{
    $page = $_POST['page'] ?? isset($_GET['page']) && $_GET['page'] != '' ? $_GET['page'] : 'Dashboard';
    switch ($page) {
        case 'Dashboard':
            $role < 4 ? include './Controllers/DashboardController.php' : include './Views/Error404.php';
            break;
        case 'Treasury':
            $role < 4 ? include './Controllers/TreasuryController.php' : include './Views/Error404.php';
            break;
        case 'Add' : 
            $role < 4 ? include "./ajout.php" : include './Views/Error404.php';
            break;
        case 'Calendar' :
            $role < 4 ? include "./calendrier.php" : include './Views/Error404.php';
            break;
        case 'Profile' :
            include "./GestionProfilAdmin.php";
            break;
        case 'Inscription' :
            $role < 4 ? include "./inscription.php" : include './Views/Error404.php';
            break;
        default:
            include './Views/Error404.php';
            break;
    }
}
