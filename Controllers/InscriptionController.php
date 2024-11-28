<?php
    require_once 'Models/InscriptionModel.php';


    session_name('BDE');
    session_set_cookie_params(86400 * 30, "/");
    session_start();

    $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
    $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité';
    $userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : null;

    // Vérification que l'e-mail est défini
    if ($userEmail === null) {
        die("Erreur : Impossible d'identifier l'utilisateur. Connectez-vous.");
    }

    // Récupération de l'ID de l'événement
    $idEvent = isset($_GET['idEvent']) ? intval($_GET['idEvent']) : null;
    if (!$idEvent) {
        die("Erreur : ID d'événement manquant ou invalide.");
    }

    $model = new InscriptionModel();

    if ($userRole === 2 || $userRole === 3 || $userRole === 5) {
        try {
            $user = $model->getUserByEmail($userEmail);

            if (!$user) {
                die("Erreur : Utilisateur non trouvé dans la base de données.");
            }

            $userId = $user['idUser'];

            if ($model->checkReservation($idEvent, $userId)) {
                $message = "Vous avez déjà réservé cet événement.";
            } else {
                $model->addReservation($idEvent, $userId);
                $message = "Réservation effectuée avec succès pour l'utilisateur : " . htmlspecialchars($userName) . ".";
            }
        } catch (PDOException $e) {
            $message = "Erreur lors de la réservation : " . $e->getMessage();
        }
    } else {
        $message = "Vous n'avez pas les droits pour effectuer une réservation.";
    }

    require 'Views/Inscription.php';
?>