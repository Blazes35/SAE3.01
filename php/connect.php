<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        include 'functions.php';
        $connection = connectToDatabase();
        
        $sql = "SELECT * FROM utilisateur";
        $init = $connection -> prepare($sql);
        $init -> execute();
    ?>
</body>
</html>