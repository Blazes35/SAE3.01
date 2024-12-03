<?php
require_once 'Models/GestionProfilAdminModel.php';


$model = new GestionProfilAdminModel();
$users = $model->getProfil();
$userAffiche = "";

// Définir les rôles
$roles = [
    1 => 'administrateur niveau 1',
    2 => 'administrateur niveau 2',
    3 => 'administrateur niveau 3',
    4 => 'membre',
    5 => 'visiteur'

];

// Traitement de mise à jour du rôle
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idUser'], $_POST['idRole'])) {
    $idUser = (int) $_POST['idUser'];
    $idRole = (int) $_POST['idRole'];

    if (array_key_exists($idRole, $roles)) {
        $model->updateRole($idUser, $idRole);

        // Vérifiez si les en-têtes ont déjà été envoyés
        if (!headers_sent()) {
            header("Location: /~inf2pj02/?page=GestionProfilAdmin");
            exit();
        } else {
            echo "Erreur : Les en-têtes ont déjà été envoyés.";
        }
    } else {
        echo "Rôle invalide.";
    }
}


foreach ($users as $user): 
    $userAffiche .= '
    <div class="profile-card">
        <div class="profile-info">
            <img src="./images/avatar.png" alt="Avatar" class="avatar">
            <div class="details">
                <h2 class="username">'. htmlspecialchars($user['nomUser']) .'</h2>
                <p class="role" id="role-'. $user['idUser'].'">
                    <span class="status-dot"></span> 
                     '. $roles[$user['idRole']].' 
                </p>
            </div>
        </div>
        <div class="profile-actions">
            <form action="/~inf2pj02/?page=GestionProfilAdmin" method="POST">
                <div class="action">
                    <label for="role-'. $user['idUser'].'">ROLE :</label>
                    <select id="role-'. $user['idUser'].'" name="idRole" class="dropdown">';
                        foreach ($roles as $id => $role):
                            $userAffiche .= '<option value="'. $id .'"'. ($user['idRole'] == $id ? ' selected' : '') .'>'. $role .'</option>';
                        endforeach;
    $userAffiche .= '</select>
                </div>
                <input type="hidden" name="idUser" value="'. $user['idUser'] .'">
                <div class="button_update">
                    <button type="submit">Mettre à jour</button>
                </div>
            </form>
            <form action="/~inf2pj02/?page=Historique" method="POST">
                <input type="hidden" name="idUser" value="'. $user['idUser'] .'">
                <button type="submit" class="historique">Voir Historique</button>
            </form>
        </div>
    </div>';
endforeach;

// Inclusion de la vue
include 'Views/GestionProfilAdmin.php';
?>

<script>
// Récupération des données de session envoyées depuis PHP
var userRole = <?php echo json_encode($userRole); ?>;
var userName = <?php echo json_encode($userName); ?>;

// Affichage des informations dans la console
console.log("Role de l'utilisateur : " + userRole);
console.log("Nom de l'utilisateur : " + userName);

// Tu peux également afficher d'autres informations sur la session si besoin
</script>