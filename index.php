    <?php
    // session_destroy();
    session_name('BDE');
    session_set_cookie_params(86400 * 30, "/");
    session_start();


    function renderLayout($viewFile, $title, $data = []){
        ob_start();
        extract($data);
        include $viewFile;
        $content = ob_get_clean();

        include './Views/Layout.php';
    }
    function renderLayoutAdmin($viewFile, $title, $data = []){
        ob_start();
        extract($data);
        include $viewFile;
        $content = ob_get_clean();

    include './Views/LayoutAdmin.php';
    }

    $page = $_POST['page'] ?? $_GET['page'] ?? 'Presentation';

    // routage

    switch ($page) {
        case 'Presentation':
            renderLayout('./Views/Main.php', 'Presentation');
            break;
        case 'Login':
            renderLayout('./Views/Login.php', 'Login');
            break;
        case 'SignUp':
            renderLayout('./Views/SignUp.php', 'SignUp');
            break;
        case 'Updatepwd':
            renderLayout('./Views/Updatepwd.php', 'Updatepwd');
            break;
        case 'Treasury':
            renderLayoutAdmin('./Views/Treasury.php', 'Treasury');
            break;
        case 'Dashboard':
            renderLayoutAdmin('./Views/Dashboard.php', 'Dashboard');
            break;
        
        default:
            renderLayout('./Views/error404.php', 'error404');
            break;
    }
    ?>