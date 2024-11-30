<?php 
require_once 'Models/AddModel.php';
$model = new AddModel();



$idUser = $_SESSION['id'];

    try {
        $connection = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
        function uploadImage($file, $type) {
            $uploadDir = match ($type) {
                'produit' => 'uploads/produits/',
                'galerie' => 'uploads/galerie/',
                'evenement' => 'uploads/evenements/',
                'actu' => 'uploads/actualites/',
                'vetement' => 'uploads/vetements/',
                default => throw new Exception('Type non valide'),
            };

            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $fileName = basename($file['name']);
            $targetFilePath = $uploadDir . $fileName;
            $validTypes = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array(strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION)), $validTypes)) {
                if (move_uploaded_file($file['tmp_name'], $targetFilePath)) return $fileName;
                throw new Exception('Erreur : Téléchargement impossible.');
            }
            throw new Exception('Erreur : Format non valide.');
        }

function addArticle($connection, $data, $file) {
    $idUser = $_SESSION['id'];
    $imageName = null; 
    if (!in_array($data['article'], ['code'])) { 
        $imageName = uploadImage($file, $data['article']); 
    }

    if ($data['article'] === 'produit') {
        $query = "INSERT INTO PRODUIT (nomProd, descProd, prixProd, qtProd, imgProd, typeProd) 
                    VALUES (:title, :desc, :price, :qt, :img, :typeProd)";
        $stmt = $connection->prepare($query);
        $stmt->execute([
            ':title'    => $data['title'],
            ':desc'     => $data['desc'],
            ':price'    => $data['price'],
            ':qt'       => $data['qt'],
            ':img'      => $imageName,
            ':typeProd' => $data['article']
        ]);
    } elseif ($data['article'] === 'evenement') {
        $query = "INSERT INTO EVENEMENT (titreEvent, descEvent, capaEvent, prixEvent, lieuEvent, imgEvent, dateEvent, minRoleEvent, minGradeEvent) 
                    VALUES (:title, :desc, :capacite, :price, :lieu, :img, :date, :minRole, :minGrade)";
        $stmt = $connection->prepare($query);
        $stmt->execute([
            ':title'    => $data['title'],
            ':desc'     => $data['desc'],
            ':capacite' => $data['capacite'],
            ':price'    => $data['price'],
            ':lieu'     => $data['lieu'],
            ':img'      => $imageName,
            ':date'     => $data['date'],
            ':minRole'  => $data['minRole'],
            ':minGrade' => $data['minGrade']
        ]);
    } elseif ($data['article'] === 'vetement') {
        $queryProd = "INSERT INTO PRODUIT (nomProd, descProd, prixProd, qtProd, imgProd, typeProd) 
                        VALUES (:title, :desc, :price, :qt, :img, :typeProd)";
        $stmtProd = $connection->prepare($queryProd);
        $stmtProd->execute([
            ':title'    => $data['title'],
            ':desc'     => $data['desc'],
            ':price'    => $data['price'],
            ':qt'       => $data['qt'],
            ':img'      => $imageName,
            ':typeProd' => $data['article']
        ]);

        $idProd = $connection->lastInsertId();
        $queryVet = "INSERT INTO VETEMENT (idProd, couleurVetement) VALUES (:idProd, :color)";
        $stmtVet = $connection->prepare($queryVet);
        $stmtVet->execute([
            ':idProd' => $idProd,
            ':color'  => $data['color']
        ]);
    } elseif($data['article'] === 'actu') {
        $query = "INSERT INTO ACTUALITE (titreActualite, descActualite, dateActualite, urlPhotoActualite, idUser)  
                    VALUES (:title, :descActualite, :dateActualite, :img, :idUser)";
        $stmt = $connection->prepare($query);
        $stmt->execute([
            ':title'          => $data['title'],
            ':descActualite'  => $data['descActualite'],
            ':dateActualite'  => $data['date'],
            ':img'            => $imageName,
            ':idUser'         => $idUser
    ]);
    } elseif ($data['article'] === 'code') {
        $query = "INSERT INTO CODEPROMO (nomCode, dateDebut, dateFin, pourcentCode, conditionCode) 
                    VALUES (:title, :dateDebut, :dateFin, :pourcentCode, :conditionCode)";
        $stmt = $connection->prepare($query);
        $stmt->execute([
            ':title'        => $data['title'],
            ':dateDebut'    => $data['dateDebut'],
            ':dateFin'      => $data['dateFin'],
            ':pourcentCode'    => $data['pourcentCode'],
            ':conditionCode'=> $data['conditionCode'] ?? null 
        ]);
    }
    
}       
        function deleteArticle($connection, $type, $title) {
            try {
                switch ($type) {
                    case 'produit':
                    case 'vetement': 
                        $query = "DELETE FROM PRODUIT WHERE nomProd = :title";
                        break;
                    case 'galerie':
                        $query = "DELETE FROM GALERIE WHERE titreGalerie = :title";
                        break;
                    case 'evenement':
                        $query = "DELETE FROM EVENEMENT WHERE titreEvent = :title";
                        break;
                    case 'actu':
                        $query = "DELETE FROM ACTUALITE WHERE titreActualite = :title";
                        break;
                    
                    case 'code':
                        $query = "DELETE FROM CODEPROMO WHERE nomCode = :title";
                        break;
        
                    default:
                        throw new Exception("Type d'article non reconnu.");
                }
                $stmt = $connection->prepare($query);
                $stmt->execute([':title' => $title]);
        
                echo "L'article de type '$type' avec le titre '$title' a été supprimé avec succès.";
            } catch (PDOException $e) {
                echo "Erreur lors de la suppression : " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erreur : " . $e->getMessage();
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'];
            $type = $_POST['article'] ?? '';
            $title = $_POST['title'] ?? '';
        
            if ($action === 'add') {
                addArticle($connection, $_POST, $_FILES['picture']);
            } elseif ($action === 'delete') {
                if (!empty($type) && !empty($title)) {
                    deleteArticle($connection, $type, $title);
                } else {
                    echo "Veuillez sélectionner un type d'article et fournir un titre.";
                }
            }
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

require 'Views/Add.php';
