<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier ou Supprimer une Actualité</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="./css/updateProduit.css" />
    <link rel="stylesheet" href="header.css" />
</head>
<body>
    <header>
        <div class="overlap-group">
            <img class="logo" src="../images/logo.png" />
            <div class="theme-claire">THEME CLAIRE</div>
        </div>
        <div class="overlap-group-2">
            <span class="material-symbols-outlined">account_circle</span>
            <div class="mon-compte">MON COMPTE</div>
            <span class="material-symbols-outlined">shopping_cart</span>
        </div>
    </header>

    <?php 
    $connect = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
    $message = '';

    // Gestion des actions : Mise à jour ou Suppression
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
        if ($_POST['action'] === 'update' && isset($_POST['idActualite'])) {
            $idActualite = intval($_POST['idActualite']);
            $titreActualite = $_POST['titreActualite'];
            $descActualite = $_POST['descActualite'];
            $dateActualite = $_POST['dateActualite'];
            $imgActualite = $_POST['currentImg']; // Valeur par défaut

            // Gestion de l'upload d'image
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/actualites/';
                $fileName = basename($_FILES['img']['name']);
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                    $imgActualite = $fileName; // On enregistre le nom du fichier
                } else {
                    $message = "Erreur lors de l'upload de l'image.";
                }
            }

            // Requête SQL pour mettre à jour l'actualité
            $updateQuery = "
                UPDATE actualite 
                SET titreActualite = :titreActualite, descActualite = :descActualite, 
                    dateActualite = :dateActualite, urlPhotoActualite = :imgActualite
                WHERE idActualite = :idActualite
            ";
            $stmt = $connect->prepare($updateQuery);
            $stmt->bindParam(':titreActualite', $titreActualite, PDO::PARAM_STR);
            $stmt->bindParam(':descActualite', $descActualite, PDO::PARAM_STR);
            $stmt->bindParam(':dateActualite', $dateActualite, PDO::PARAM_STR);
            $stmt->bindParam(':imgActualite', $imgActualite, PDO::PARAM_STR);
            $stmt->bindParam(':idActualite', $idActualite, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $message = "Actualité mise à jour avec succès !";
                $_SESSION['adminPanel'] = 0;
                header('Location: /?page=News');
            } else {
                $message = "Erreur lors de la mise à jour : " . implode(", ", $stmt->errorInfo());
            }
        } elseif ($_POST['action'] === 'delete' && isset($_POST['idActualite'])) {
            // Suppression de l'actualité
            $idActualite = intval($_POST['idActualite']);
            $deleteQuery = "DELETE FROM actualite WHERE idActualite = :idActualite";
            $stmt = $connect->prepare($deleteQuery);
            $stmt->bindParam(':idActualite', $idActualite, PDO::PARAM_INT);

            if ($stmt->execute()) {
                $_SESSION['adminPanel'] = 0;
                header('Location: /?page=News');
            } else {
                $message = "Erreur lors de la suppression : " . implode(", ", $stmt->errorInfo());
            }
        }
    }

    // Récupération des données actuelles de l'actualité
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $idActualite = intval($_POST['idActualite']);
        $selectQuery = "SELECT * FROM actualite WHERE idActualite = :id";
        $stmt = $connect->prepare($selectQuery);
        $stmt->bindParam(':id', $idActualite, PDO::PARAM_INT);
        $stmt->execute();
        $actu = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($actu) {
    ?>

    <div class="container">
        <h1>Modifier ou Supprimer une Actualité</h1>
        <p><?php echo $message; ?></p>

        <!-- Formulaire de mise à jour -->
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="idActualite" value="<?php echo htmlspecialchars($actu['idActualite']); ?>" />
            <input type="hidden" name="currentImg" value="<?php echo htmlspecialchars($actu['urlPhotoActualite']); ?>" />
            <input type="hidden" name="action" value="update" />

            <div>
                <label for="titreActualite">Titre de l'actualité</label>
                <input type="text" id="titreActualite" name="titreActualite" 
                    value="<?php echo htmlspecialchars($actu['titreActualite']); ?>" required />
            </div>
            <br>
            <div>
                <label for="descActualite">Description</label>
                <input type="text" id="descActualite" name="descActualite" 
                    value="<?php echo htmlspecialchars($actu['descActualite']); ?>" />
            </div>
            <br>
            <div>
                <label for="dateActualite">Date</label>
                <input type="text" id="dateActualite" name="dateActualite" 
                    value="<?php echo htmlspecialchars($actu['dateActualite']); ?>" required />
            </div>
            <br>
            <div>
                <label for="img">Image</label>
                <input type="file" id="img" name="img" accept="image/*" />
                <p>Image actuelle : <strong><?php echo htmlspecialchars($actu['urlPhotoActualite']); ?></strong></p>
                <img src="uploads/actualites/<?php echo htmlspecialchars($actu['urlPhotoActualite']); ?>" 
                    alt="Image actuelle" style="max-width: 200px; height: auto;" />
            </div>
            <br>
            <button type="submit">Mettre à jour</button>
        </form>

        <br>

        <!-- Formulaire de suppression -->
        <form method="POST" action="">
            <input type="hidden" name="idActualite" value="<?php echo htmlspecialchars($actu['idActualite']); ?>" />
            <input type="hidden" name="action" value="delete" />
            <button type="submit" style="background-color: red; color: white;">Supprimer l'actualité</button>
        </form>
    </div>

    <?php
        } else {
            echo "<p>Actualité introuvable.</p>";
        }
    } else {
        echo "<p>Aucun ID fourni.</p>";
    }
    ?>
    <script>
    // Récupération des données de session envoyées depuis PHP
    var userRole = <?php echo json_encode($userRole); ?>;
    var userName = <?php echo json_encode($userName); ?>;

    // Affichage des informations dans la console
    console.log("Role de l'utilisateur : " + userRole);
    console.log("Nom de l'utilisateur : " + userName);
</script>
</body>
</html>
