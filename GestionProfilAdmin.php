<?php
session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();
$info_person = "
    SELECT UTILISATEUR.idUser, UTILISATEUR.nomUser, POSSEDER.idRole 
    FROM UTILISATEUR
    INNER JOIN POSSEDER ON UTILISATEUR.idUser = POSSEDER.idUser
";
require_once 'Models/DBModel.php';
$model = new DBModel();
$connect = $model->getDB();
$launch = $connect->prepare($info_person);
$launch->execute();
$users = $launch->fetchAll(PDO::FETCH_ASSOC);

// Définir les rôles
$roles = [
    1 => 'Visiteur',
    2 => 'Membre',
    3 => 'Administrateur - Niveau 1'
    
];

// Traitement de mise à jour du rôle (optionnel)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = $_POST['idUser'];
    $idRole = $_POST['idRole'];

    if (in_array($idRole, array_keys($roles))) {
        $update_role = "UPDATE POSSEDER SET idRole = :idRole WHERE idUser = :idUser";
        $stmt = $connect->prepare($update_role);
        $stmt->bindParam(':idRole', $idRole, PDO::PARAM_INT);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: gestionProfilAdmin.php");
        exit();
    } else {
        echo "Rôle invalide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Profils</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="gestionProfilAdmin.css">
</head>
<body>


    <div class="container">
        <h1 class="title">GESTION PROFILS</h1>
        <div class="search-bar">
            <input type="text" placeholder="Profil" class="search-input">
        </div>

        <?php foreach ($users as $user): ?>
            <div class="profile-card">
                <div class="profile-info">
                    <img src="./images/avatar.png" alt="Avatar" class="avatar">
                    <div class="details">
                        <h2 class="username"><?php echo htmlspecialchars($user['nomUser']); ?></h2>
                        <p class="role" id="role-<?php echo $user['idUser']; ?>">
                            <span class="status-dot"></span> 
                            <?php echo $roles[$user['idRole']]; ?>
                        </p>
                    </div>
                </div>
                <div class="profile-actions">
                    <form action="gestionProfilAdmin.php" method="POST">
                        <div class="action">
                            <label for="role-<?php echo $user['idUser']; ?>">ROLE :</label>
                            <select id="role-<?php echo $user['idUser']; ?>" name="idRole" class="dropdown">
                                <?php foreach ($roles as $id => $role): ?>
                                    <option value="<?php echo $id; ?>" <?php if ($user['idRole'] == $id) echo 'selected'; ?>>
                                        <?php echo $role; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="idUser" value="<?php echo $user['idUser']; ?>">
                        <div class="button_update">
                            <button type="submit">Mettre à jour</button>
                        </div>
                        <a class="historique" href="historique.php?idUser=<?php echo $user['idUser']; ?>">
                            <button type="button">Voir l'historique</button>
                        </a>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
            // Récupération des données de session envoyées depuis PHP
            var userRole = <?php echo json_encode($userRole); ?>;
            var userName = <?php echo json_encode($userName); ?>;

            // Affichage des informations dans la console
            console.log("Role de l'utilisateur : " + userRole);
            console.log("Nom de l'utilisateur : " + userName);

            // Tu peux également afficher d'autres informations sur la session si besoin
        </script>
</body>
</html>
