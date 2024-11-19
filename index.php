<?php
//include controller



session_start();


function renderLayout($viewFile, $title, $data = []){
    ob_start();
    extract($data);
    include $viewFile;
    $content = ob_get_clean();

    include './Views/Layout.php';
}

$page = $_POST['page'] ?? $_GET['page'] ?? 'presentation';

// routage

switch ($page) {
    case 'presentation':
        renderLayout('./Views/Main.php', 'presentation');
        break;
    case 'Login':
        renderLayout('./Views/Login.php', 'Login');
        break;
    case 'createUser':
        renderLayout('./Views/createUser.php', 'createUser');
        break;
    case 'changePwd':
        renderLayout('./Views/changePwd.php', 'changePwd');
        break;
    default:
        renderLayout('./Views/error404.php', 'error404');
        break;
}
?>