<?php
// Connexion à la base de données
$connect = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');

// Récupérer les utilisateurs et leurs informations avec leurs rôles
$info_person = "
    SELECT UTILISATEUR.idUser, UTILISATEUR.nomUser, POSSEDER.idRole 
    FROM UTILISATEUR
    INNER JOIN POSSEDER ON UTILISATEUR.idUser = POSSEDER.idUser
";
$launch = $connect->prepare($info_person);
$launch->execute();
$users = $launch->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les rôles
$roles = [
    1 => 'Visiteur',
    2 => 'Membre',
    3 => 'Administrateur - Niveau 1',
    4 => 'Administrateur - Niveau 2',
    5 => 'Administrateur - Niveau 3'
];

$sql_filtre_visiteur = "SELECT UTILISATEUR.idUser, UTILISATEUR.nomUser, POSSEDER.idRole FROM UTILISATEUR 
                        INNER JOIN POSSEDER ON UTILISATEUR.idUser = POSSEDER.idUser WHERE idRole = 1";
$launch_filtre_visiteur = $connect->prepare($sql_filtre_visiteur);
$launch_filtre_visiteur->execute();
$visiteurs = $launch_filtre_visiteur->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire de mise à jour du rôle
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idUser = $_POST['idUser'];
    $idRole = $_POST['idRole'];

    // Vérification que l'idRole est bien un numéro valide
    if (in_array($idRole, array_keys($roles))) {  // Vérifie si l'idRole fait partie des clés valides
        // Mise à jour du rôle dans la table POSSEDER
        $update_role = "UPDATE POSSEDER SET idRole = :idRole WHERE idUser = :idUser";
        $stmt = $connect->prepare($update_role);
        $stmt->bindParam(':idRole', $idRole, PDO::PARAM_INT);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();

        // Rediriger vers la même page pour éviter le double envoi du formulaire
        header("Location: gestionProfilAdmin.php");
        exit;  // Assurez-vous de sortir après la redirection
    } else {
        // Si l'idRole n'est pas valide
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
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="gestionProfilAdmin.css" />
</head>
<body>
    <div class="menu">
        <div class="logo-theme">
            <img class="logo" src="./images/logo-sans-fond.png" />
            <div class="theme-claire">THEME CLAIRE</div>
        </div>
        <div class="compte">
            <span class="material-symbols-outlined">account_circle</span>
            <a href="compte.html" class="mon-compte" style="cursor: pointer;">MON COMPTE</a>
        </div>
        <div class="overlap-group">
            <div class="titre-de-page">
                <div class="overlap-group-3">
                    <a href="tableau.html" class="tableau" style="cursor: pointer;">TABLEAU DE BORD</a>
                    <a href="calendrier.html" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                    <a href="profils.html" class="profils" style="cursor: pointer;">GESTION PROFILS</a>
                    <a href="tresorie.html" class="tresorie" style="cursor: pointer;">TRÉSORIE</a>
                    <a href="parametres.html" class="parametres" style="cursor: pointer;">PARAMÈTRES</a>
                    <a href="editer.html" class="editer" style="cursor: pointer;">EDITER CONTENU</a>
                </div>
            </div>
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
                        <input type="hidden" name="idUser" value="<?php echo $user['idUser']; ?>"> <!-- L'ID de l'utilisateur -->
                        <button type="submit">Mettre à jour</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
