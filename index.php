<?php
session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();


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
    case 'Treasury':
        include './Controllers/TreasuryController.php';
        break;
    case 'Dashboard':
        include './Controllers/DashboardController.php';
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
    case 'Add' : 
        include "./ajout.php";
            break;
    case 'Calendar' :
        include "./calendrier.php";
        break;
    default:
        include './Views/Error404.php';
        break;
}