<?php
require_once 'Models/UpdateEventModel.php';
$model = new UpdateEventModel();
$connect = $model->getDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update') {
        echo "<p>update</p>";
        $idEvent = intval($_POST['idEvent']);
        $nomEvent = $_POST['titre'];
        $descEvent = $_POST['desc'];
        $minRole = intval($_POST['minRole']);
        $minGrade = intval($_POST['minGrade']);
        $prixEvent = floatval($_POST['price']);
        $capaEvent = intval($_POST['capacite']);
        $imgEvent = $_POST['currentImg'];
        $model->updateEvent($idEvent, $nomEvent, $descEvent, $minRole, $minGrade, $prixEvent, $capaEvent, $imgEvent);
        $_SESSION['adminPanel'] = 0;
        header('Location: ?page=Event');
    }elseif ($_POST['action'] ===  'delete') {
        // Suppression de l'événement
        $idEvent = intval($_POST['idEvent']);
        $result = $model->deleteEvent($idEvent);
        if ($result) {
            $_SESSION['adminPanel'] = 0;
            header('Location: ?page=Event');
        }else{
            echo "<script>alert('Erreur lors de la suppression l'évènement est lié à des inscriptions')</script>";
        }
    }
}

if (isset($_POST['update'])) {
    $idEvent = intval($_POST['idEvent']);
    $event = $model->getEvent($idEvent);
}


include 'Views/UpdateEvent.php';
?>
