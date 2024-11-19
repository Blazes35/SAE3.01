<?php 
require 'Controllers/loginController.php';
$controller = new loginController();
?>

<!-- Link to the CSS file -->
<link rel="stylesheet" href="login.css"> 

<?php echo $controller->renderLayout(); ?> <!-- Display the layout -->
<!-- The following code is the layout of the website -->