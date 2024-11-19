<?php
//include controller



session_start();


function renderLayout($viewFile, $data = []){
    ob_start();
    extract($data);
    include $viewFile;
    $content = ob_get_clean();

    include './Views/Layout.php';
}

$page = $_GET['page'] ?? 'Main';
echo $page;

// routage

switch ($page) {
    case 'Main':
        echo"Main";
        renderLayout('./Views/Main.php');
        break;
    case 'Login':
        echo"Login";
        renderLayout('./Views/Login.php');
        break;
    case 'createUser':
        echo"createUser";
        renderLayout('./Views/createUser.php');
        break;
    case 'changePwd':
        echo"changePwd";
        renderLayout('./Views/changePwd.php');
        break;
    default:
        echo"error404";
        renderLayout('./Views/error404.php');
        break;
}
?>