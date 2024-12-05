<?php
require_once 'Models/DBModel.php';

class AddModel extends DBModel{
    public function __construct(){
        parent::__construct();
    }
    function uploadImage($file, $type) {
        $uploadDir = '/home/inf2pj02/public_html/uploads/' . $type . '/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
        $fileName = basename($file['name']);
        $targetFilePath = $uploadDir . $fileName;
    
        $validTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION)), $validTypes)) {
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                return $fileName;
            }
            throw new Exception('Erreur : Téléchargement impossible.');
        }
        throw new Exception('Erreur : Format non valide.');
    }
    function deleteArticle($type, $title) {
            $query = match ($type) {
                'produit','vetement' => "DELETE FROM PRODUIT WHERE nomProd = :title",
                'galerie' => "DELETE FROM GALERIE WHERE titreGalerie = :title",
                'evenement' => "DELETE FROM EVENEMENT WHERE titreEvent = :title",
                'actu' => "DELETE FROM ACTUALITE WHERE titreActualite = :title",
                'code' => "DELETE FROM CODEPROMO WHERE nomCode = :title",
                default => throw new Exception('Type d\'article non reconnu.'),
            };
            $stmt = self::$db->prepare($query);
            $stmt->execute([':title' => $title]);
            return "L'article de type '$type' avec le titre '$title' a été supprimé avec succès.";
    }
    function addArticle($data, $file) {
        $idUser = $_SESSION['id'];
        $imageName = null; 
        if (!in_array($data['article'], ['code'])) { 
            $imageName = self::uploadImage($file, $data['article']); 
        }
        switch ($data['article']){
            case 'produit':
                $query = "INSERT INTO PRODUIT (nomProd, descProd, prixProd, qtProd, imgProd, typeProd) 
                        VALUES (:title, :desc, :price, :qt, :img, :typeProd)";
                $stmt = self::$db->prepare($query);
                $stmt->execute([
                    ':title'    => $data['title'],
                    ':desc'     => $data['desc'],
                    ':price'    => $data['price'],
                    ':qt'       => $data['qt'],
                    ':img'      => $imageName,
                    ':typeProd' => $data['article']
                ]); 
                break;
            case 'evenement':
                $query = "INSERT INTO EVENEMENT (titreEvent, descEvent, capaEvent, prixEvent, lieuEvent, imgEvent, dateEvent, minRoleEvent, minGradeEvent) 
                        VALUES (:title, :desc, :capacite, :price, :lieu, :img, :date, :minRole, :minGrade)";
                $stmt = self::$db->prepare($query);
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
                break;
            case 'vetement':
                $idProd = self::$db->lastInsertId();
                $queryVet = "INSERT INTO VETEMENT (idProd, couleurVetement) VALUES (:idProd, :color)";
                $stmtVet = self::$db->prepare($queryVet);
                $stmtVet->execute([
                    ':idProd' => $idProd,
                    ':color'  => $data['color']
                ]);
                break;
            case 'actu':
                $query = "INSERT INTO ACTUALITE (titreActualite, descActualite, dateActualite, urlPhotoActualite, idUser)  
                            VALUES (:title, :descActualite, :dateActualite, :img, :idUser)";
                $stmt = self::$db->prepare($query);
                $stmt->execute([
                    ':title'          => $data['title'],
                    ':descActualite'  => $data['descActualite'],
                    ':dateActualite'  => $data['date'],
                    ':img'            => $imageName,
                    ':idUser'         => $idUser
                ]);
                break;
            case 'code':
                $query = "INSERT INTO CODEPROMO (nomCode, dateDebut, dateFin, pourcentCode, conditionCode) 
                        VALUES (:title, :dateDebut, :dateFin, :pourcentCode, :conditionCode)";
                $stmt = self::$db->prepare($query);
                $stmt->execute([
                    ':title'        => $data['title'],
                    ':dateDebut'    => $data['dateDebut'],
                    ':dateFin'      => $data['dateFin'],
                    ':pourcentCode'    => $data['pourcentCode'],
                    ':conditionCode'=> $data['conditionCode'] ?? null 
                ]);
                break;
            default:
                break;
        }
    }      
}