<?php
require_once 'Models/GestionProfilAdminModel.php';


$model = new GestionProfilAdminModel();
$users = $model->getProfil();
$userAffiche = "";

// Définir les rôles
$roles = [
    1 => 'Visiteur',
    2 => 'Membre',
    3 => 'Administrateur - Niveau 1'
];

// Traitement de mise à jour du rôle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idUser'], $_POST['idRole'])) {
    $idUser = (int) $_POST['idUser'];
    $idRole = (int) $_POST['idRole'];

    if (array_key_exists($idRole, $roles)) {
        $model->updateRole($idUser, $idRole);
        header("Location: gestionProfilAdmin.php");
        exit();
    } else {
        echo "Rôle invalide.";
    }
}

// Génération des cartes de profil
foreach ($users as $user) {
    $userAffiche .= '
    <div class="profile-card">
        <div class="profile-info">
            <img src="./images/avatar.png" alt="Avatar" class="avatar">
            <div class="details">
                <h2 class="username">' . htmlspecialchars($user['nomUser']) . '</h2>
                <p class="role">
                    <span class="status-dot"></span> 
                    ' . $roles[$user['idRole']] . '
                </p>
            </div>
        </div>
        <div class="profile-actions">
            <!-- Formulaire de mise à jour du rôle -->
            <form action="gestionProfilAdmin.php" method="POST">
                <div class="action">
                    <label for="role-' . $user['idUser'] . '">ROLE :</label>
                    <select id="role-' . $user['idUser'] . '" name="idRole" class="dropdown">';
                    foreach ($roles as $id => $role) {
                        $userAffiche .= '<option value="' . $id . '"' . ($user['idRole'] == $id ? ' selected' : '') . '>' . $role . '</option>';
                    }
    $userAffiche .= '</select>
                </div>
                <input type="hidden" name="idUser" value="' . $user['idUser'] . '">
                <div class="button_update">
                    <button type="submit">Mettre à jour</button>
                </div>
            </form>
            
            <form action="historique.php" method="GET">
                <input type="hidden" name="idUser" value="' . $user['idUser'] . '">
                <button type="submit" class="historique">Voir Historique</button>
            </form>
        </div>
    </div>';
}

// Inclusion de la vue
include 'Views/GestionProfilAdmin.php';
?>
