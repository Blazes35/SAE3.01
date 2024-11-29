<?php 
require_once 'Models/HaveGuardModel.php';
$model = new HaveGuardModel();

$gradeAff='';


if (isset($_POST['priceSelected'])) {
    $grade = $_POST['priceSelected'];
    $nomgrade = $model->getNameGuard($grade);
    echo "La session" . $_SESSION['grade'];
    echo "Le grade" . $grade;

    // Vérifier si le grade sélectionné est inférieur au grade actuel de l'utilisateur
    if ($grade < $_SESSION['grade']) {
        $gradeAff .= '<div class="dejagrade">
            <p>Vous avez déjà un grade supérieur à celui-ci</p>
        </div>';
    } else { 
        // Mettre à jour le grade
        $update = $model->updateGuard($grade);
        
        // Si la mise à jour est réussie
        if ($update) {
            $gradeAff .= '<div class="updategrade">
                <p>Votre grade ' . $nomgrade['nomGrade'] . ' a été acheté avec succès</p>
            </div>';
        } else {
            // En cas d'échec de la mise à jour
            $gradeAff .= '<div class="updategrade">
                <p>Il y a eu un problème avec votre achat du grade ' . $nomgrade . '</p>
            </div>';
        }
    }
}

include 'Views/HaveGuard.php';
?>