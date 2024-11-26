<?php
session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();
$role =  isset($_SESSION['role']) ? $_SESSION['role'] : 5;


function renderLayoutAdmin($viewFile, $title, $data = []){
        ob_start();
        extract($data);
        include $viewFile;
        $content = ob_get_clean();
    include './Views/LayoutAdmin.php';
}


    $page = $_POST['page'] ?? $_GET['page'] ?? 'Accueil';

    echo '<script>console.log("'.$page.'")</script>';
    // routage
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
        include './Controllers/actuController.php';
        break;
    case 'Shop' :
        include './boutique.php';
        break;
    case 'Basket' :
        include './Controllers/BasketController.php';
        break;
    case 'Event' :
        include "./event.php";
        break;
    case 'News' : 
        include "./actu.php";
        break;
    case 'Treasury':
        $role < 4 ? include './Controllers/TreasuryController.php' : include './Views/Error404.php';
        break;
    case 'Dashboard':
        $role < 4 ? include './Controllers/DashboardController.php' : include './Views/Error404.php';
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
    default:
        include './Views/Error404.php';
        break;
}