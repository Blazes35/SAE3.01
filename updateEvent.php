<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évenement</title>
    <!-- Lien pour importer les Material Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="updateEvent.css" />
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
    <div class="box">
        <div class="rectangle">
            <div class="titre-de-page">
                <div class="overlap-group-3">
                    <a href="presentation.html" class="presentation" style="cursor: pointer;">QUI SOMMES NOUS</a>
                    <a href="evenement.html" class="evenement" style="cursor: pointer;">ÉVENEMENTS</a>
                    <a href="calendrier.html" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                    <a href="galerie.html" class="galerie" style="cursor: pointer;">GALERIE</a>
                    <a href="boutique.html" class="boutique" style="cursor: pointer;">BOUTIQUE</a>
                </div>
            </div>
        </div>
    </div>
<body>

<?php 
// Connexion à la base de données
try {
    $connect = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$message = '';

// Traitement des requêtes POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $idEvent = intval($_POST['idEvent']);

    if ($action === 'update') {
        $nomEvent = $_POST['titre'];
        $descEvent = $_POST['desc'];
        $minRole = intval($_POST['minRole']);
        $minGrade = intval($_POST['minGrade']);
        $prixEvent = floatval($_POST['price']);
        $capaEvent = intval($_POST['capacite']);
        $imgEvent = $_POST['currentImg'];

        // Validation des champs minRole et minGrade
        if ($minRole < 0 || $minRole > 4) {
            $message = "Le min rôle doit être compris entre 0 et 4.";
        } elseif ($minGrade < 0 || $minGrade > 4) {
            $message = "Le min grade doit être compris entre 0 et 4.";
        } else {
            // Gestion de l'image uploadée
            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/evenements/';
                $fileName = basename($_FILES['img']['name']);
                $uploadFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadFile)) {
                    $imgEvent = $fileName;
                } else {
                    $message = "Erreur lors de l'upload de l'image.";
                }
            }

            // Mise à jour de l'événement
            $updateQuery = "
                UPDATE evenement 
                SET titreEvent = :titreEvent, descEvent = :descEvent, prixEvent = :prixEvent, 
                    capaEvent = :capaEvent, imgEvent = :imgEvent, minRoleEvent = :minRole, 
                    minGradeEvent = :minGrade
                WHERE idEvent = :idEvent
            ";
            $stmt = $connect->prepare($updateQuery);

            $stmt->bindParam(':titreEvent', $nomEvent, PDO::PARAM_STR);
            $stmt->bindParam(':descEvent', $descEvent, PDO::PARAM_STR);
            $stmt->bindParam(':prixEvent', $prixEvent, PDO::PARAM_STR);
            $stmt->bindParam(':capaEvent', $capaEvent, PDO::PARAM_INT);
            $stmt->bindParam(':imgEvent', $imgEvent, PDO::PARAM_STR);
            $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);
            $stmt->bindParam(':minRole', $minRole, PDO::PARAM_INT);
            $stmt->bindParam(':minGrade', $minGrade, PDO::PARAM_INT);

            try {
                if ($stmt->execute()) {
                    $message = "Événement mis à jour avec succès !";
                } else {
                    $message = "Erreur lors de la mise à jour de l'événement.";
                }
            } catch (PDOException $e) {
                $message = "Erreur SQL : " . $e->getMessage();
            }
        }
    } elseif ($action === 'delete') {
        // Suppression de l'événement
        $deleteQuery = "DELETE FROM evenement WHERE idEvent = :idEvent";
        $stmt = $connect->prepare($deleteQuery);
        $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);

        try {
            if ($stmt->execute()) {
                $message = "Événement supprimé avec succès !";
                echo "<p>$message</p>";
                exit;
            } else {
                $message = "Erreur lors de la suppression de l'événement.";
            }
        } catch (PDOException $e) {
            $message = "Erreur SQL : " . $e->getMessage();
        }
    }
}

// Chargement des données pour l'affichage du formulaire
if (isset($_GET['id'])) {
    $idEvent = intval($_GET['id']);
    $selectQuery = "SELECT * FROM evenement WHERE idEvent = :idEvent";
    $stmt = $connect->prepare($selectQuery);
    $stmt->bindParam(':idEvent', $idEvent, PDO::PARAM_INT);

    try {
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($event) {
?>

<h1>Modifier ou supprimer un événement</h1>
<p><?php echo htmlspecialchars($message); ?></p>

<!-- Formulaire de mise à jour -->
<form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="idEvent" value="<?php echo htmlspecialchars($event['idEvent']); ?>" />
    <input type="hidden" name="currentImg" value="<?php echo htmlspecialchars($event['imgEvent']); ?>" />
    <input type="hidden" name="action" value="update" />

    <div>
        <label for="titre">Nom de l'événement</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($event['titreEvent']); ?>" required />
    </div>
    <br>
    <div>
        <label for="desc">Description</label>
        <input type="text" id="desc" name="desc" value="<?php echo htmlspecialchars($event['descEvent']); ?>" />
    </div>
    <br>
    <div>
        <label for="price">Prix</label>
        <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($event['prixEvent']); ?>" required />
    </div>
    <br>
    <div>
        <label for="capacite">Capacité</label>
        <input type="number" id="capacite" name="capacite" value="<?php echo htmlspecialchars($event['capaEvent']); ?>" required />
    </div>
    <br>
    <div>
        <label for="minRole">Min rôle</label>
        <input type="number" id="minRole" name="minRole" value="<?php echo htmlspecialchars($event['minRoleEvent']); ?>" required min="0" max="4" />
    </div>
    <br>
    <div>
        <label for="minGrade">Min grade</label>
        <input type="number" id="minGrade" name="minGrade" value="<?php echo htmlspecialchars($event['minGradeEvent']); ?>" required min="0" max="4" />
    </div>
    <br>
    <div>
        <label for="img">Image</label>
        <input type="file" id="img" name="img" accept="image/*" />
        <p>Image actuelle : <strong><?php echo htmlspecialchars($event['imgEvent']); ?></strong></p>
        <img src="uploads/evenements/<?php echo htmlspecialchars($event['imgEvent']); ?>" alt="Image actuelle" style="max-width: 200px; height: auto;" />
    </div>
    <br>
    <button type="submit">Mettre à jour</button>
</form>
<br>

<!-- Formulaire de suppression -->
<form method="POST" action="">
    <input type="hidden" name="idEvent" value="<?php echo htmlspecialchars($event['idEvent']); ?>" />
    <input type="hidden" name="action" value="delete" />
    <button type="submit" style="background-color: red; color: white;">Supprimer l'événement</button>
</form>

<?php
        } else {
            echo "<p>Événement introuvable.</p>";
        }
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
} else {
    echo "<p>Aucun ID fourni.</p>";
}
?>
</body>
</html>
