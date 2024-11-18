<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $connection = new PDO('mysql:host=https://la-projets.univ-lemans.fr/pj-pma;dbname=inf2pj_02', 'root', '');
        
        $sql = "SELECT * FROM USERS";
        $init = $connection -> prepare($sql);
        $init -> execute();
    ?>
</body>
</html>