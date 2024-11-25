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
        renderLayoutAdmin('./Views/Treasury.php', 'Treasury');
        break;
    case 'Dashboard':
            renderLayoutAdmin('./Views/Dashboard.php', 'Dashboard');
            break;
    default:
        include './Views/Error404.php';
        break;
}