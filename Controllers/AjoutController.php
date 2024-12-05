<?php 
require_once 'Models/AjoutModel.php';
$model = new AjoutModel();

$message = '';
$articlesAff = '';
$totalArticles = 0;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['article'])) {
    $type = $_GET['article'];
    $articles = $model->getArticlesByType($type);

    if ($articles) {
        foreach ($articles as $article) {
            $articlesAff .= '<div class="article">
                <div class="image">';
            if (!empty($article['img'])) {
                $articlesAff .= '<img src="uploads/' . $type . '/' . $article['img'] . '" alt="' . htmlspecialchars($article['titre']) . '" />';
            } else {
                $articlesAff .= '<img src="/images/default.png" alt="default image" />';
            }
            $articlesAff .= '</div>
                <div class="details">
                    <p>Titre : ' . htmlspecialchars($article['titre']) . '</p>
                    <p>Description : ' . htmlspecialchars($article['description']) . '</p>
                    <p>Prix : ' . htmlspecialchars($article['prix'] ?? 'N/A') . '€</p>
                </div>
                <div class="actions">
                    <form method="POST" action="Controllers/AjoutController.php">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="type" value="' . htmlspecialchars($type) . '">
                        <input type="hidden" name="titre" value="' . htmlspecialchars($article['titre']) . '">
                        <button type="submit">Supprimer</button>
                    </form>
                </div>
            </div>';
        }
    } else {
        $message = 'Aucun article trouvé pour ce type.';
    }
}

// Gestion des actions POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $type = $_POST['type'] ?? '';
    $titre = $_POST['titre'] ?? '';

    try {
        if ($action === 'add') {
            $model->addArticle($_POST, $_FILES['picture']);
            $message = 'Article ajouté avec succès.';
        } elseif ($action === 'delete' && !empty($type) && !empty($titre)) {
            $model->deleteArticle($type, $titre);
            $message = 'Article supprimé avec succès.';
        } else {
            $message = 'Action non reconnue ou données manquantes.';
        }
        header("Location: /Views/Ajout.php?message=" . urlencode($message));
        exit();
    } catch (Exception $e) {
        $message = 'Erreur : ' . $e->getMessage();
    }
}

include 'Views/Ajout.php';

?>
