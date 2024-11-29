<?php 
require_once 'DBModel.php';
class AjoutModel extends DBModel{
    public function __construct(){
        parent::__construct();
    }
          
    public function uploadImage($file, $type) {
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

    public function addArticle($data, $file) {
        $imageName = null; 
        if (!in_array($data['article'], ['code'])) { 
            $imageName = $this->uploadImage($file, $data['article']); 
        }

        $query = match ($data['article']) {
            'produit' => "INSERT INTO PRODUIT (nomProd, descProd, prixProd, qtProd, imgProd, typeProd) 
                          VALUES (:title, :desc, :price, :qt, :img, :typeProd)",
            'evenement' => "INSERT INTO EVENEMENT (titreEvent, descEvent, capaEvent, prixEvent, lieuEvent, imgEvent, dateEvent, minRoleEvent, minGradeEvent) 
                            VALUES (:title, :desc, :capacite, :price, :lieu, :img, :date, :minRole, :minGrade)",
            'actu' => "INSERT INTO ACTUALITE (titreActualite, descActualite, dateActualite, urlPhotoActualite, idUser)  
                       VALUES (:title, :descActualite, :dateActualite, :img, :idUser)",
            'code' => "INSERT INTO CODEPROMO (nomCode, dateDebut, dateFin, pourcentCode, conditionCode) 
                       VALUES (:title, :dateDebut, :dateFin, :pourcentCode, :conditionCode)",
            default => throw new Exception('Type non valide.'),
        };

        $stmt = self::$db->prepare($query);
        $stmt->execute([
            ':title' => $data['title'],
            ':desc' => $data['desc'] ?? null,
            ':price' => $data['price'] ?? null,
            ':qt' => $data['qt'] ?? null,
            ':img' => $imageName,
            ':typeProd' => $data['article'] ?? null,
            ':capacite' => $data['capacite'] ?? null,
            ':lieu' => $data['lieu'] ?? null,
            ':date' => $data['date'] ?? null,
            ':minRole' => $data['minRole'] ?? null,
            ':minGrade' => $data['minGrade'] ?? null,
            ':descActualite' => $data['descActualite'] ?? null,
            ':dateDebut' => $data['dateDebut'] ?? null,
            ':dateFin' => $data['dateFin'] ?? null,
            ':pourcentCode' => $data['pourcentCode'] ?? null,
            ':conditionCode' => $data['conditionCode'] ?? null,
            ':idUser' => $_SESSION['id'],
        ]);
    }

    public function deleteArticle($type, $title) {
        $query = match ($type) {
            'produit', 'vetement' => "DELETE FROM PRODUIT WHERE nomProd = :title",
            'galerie' => "DELETE FROM GALERIE WHERE titreGalerie = :title",
            'evenement' => "DELETE FROM EVENEMENT WHERE titreEvent = :title",
            'actu' => "DELETE FROM ACTUALITE WHERE titreActualite = :title",
            'code' => "DELETE FROM CODEPROMO WHERE nomCode = :title",
            default => throw new Exception("Type d'article non reconnu."),
        };

    }
}
?>