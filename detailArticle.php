<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail produit</title>
</head>
<body>
<main>
        <?php 
        $sql = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
        if (isset($_GET['id'])) {
            $idProd = intval($_GET['id']);
            $recup_info = "SELECT * FROM PRODUIT WHERE idProd = :id";
            $init = $sql->prepare($recup_info);
            $init->bindParam(':id', $idProd, PDO::PARAM_INT);
            $init->execute();
            if ($product = $init->fetch(PDO::FETCH_ASSOC)) {
                echo "<h1>" . htmlspecialchars($product['nomProd']) . "</h1>";
                echo "<p>Type : " . htmlspecialchars($product['typeProd']) . "</p>";
                echo "<p>Description : " . htmlspecialchars($product['descProd']) . "</p>";
                echo "<p>Prix : " . htmlspecialchars($product['prixProd']) . " €</p>";
                echo "<p>Quantité disponible : " . htmlspecialchars($product['qtProd']) . "</p>";
                echo "<img src='uploads/" . htmlspecialchars($product['imgProd']) . "' alt='" . htmlspecialchars($product['nomProd']) . "' />";
            } else {
                echo "<p>Produit introuvable.</p>";
            }
        } else {
            echo "<p>Paramètre invalide.</p>";
        }
        ?>
    </main>
</body>
</html>