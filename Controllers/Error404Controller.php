<?php   
    include 'Views/Error404.php'
    ob_start();
    include 'Views/Error404.php';
    $content = ob_get_clean();
    echo $content;
?>