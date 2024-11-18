
<?php 
require 'Controllers/controller.php';
$controller = new Controller();
?>

<link rel="stylesheet" href="style.css"> <!-- Link to the CSS file -->

<?php echo $controller->renderLayout(); ?> <!-- Display the layout -->

<!-- The following code is the layout of the website -->