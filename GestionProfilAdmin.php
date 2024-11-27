<?php
// Démarrage de la session et connexion à la base de données
session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();

// Connexion PDO à la base de données
$connect = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');



// Récupération des données utilisateurs
$info_person = "
    SELECT UTILISATEUR.idUser, UTILISATEUR.nomUser, POSSEDER.idRole 
    FROM UTILISATEUR
    INNER JOIN POSSEDER ON UTILISATEUR.idUser = POSSEDER.idUser
";
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
    <div class="menu">
        <div class="logo-theme">
            <img class="logo" src="./images/logo-sans-fond.png">
            <div class="theme-claire">THEME CLAIRE</div>
        </div>
        <div class="compte">
            <span class="material-symbols-outlined">account_circle</span>
            <a href="compte.html" class="mon-compte">MON COMPTE</a>
        </div>
    </div>

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
                        <a href="historique.php">
                            <button type="historique">Voir l'historique</button>
                        </a>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
