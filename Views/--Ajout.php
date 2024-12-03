<?php

$title = 'Gestion des Articles';
ob_start();

?>

<link rel="stylesheet" href="css/articles.css" />

<div class="container">
    <div class="titre-section">GESTION DES ARTICLES</div>

    <div class="messages">
        <p><?= htmlspecialchars($message ?? ''); ?></p>
    </div>

    <!-- Liste des articles -->
    <div class="articles-header">
        <div class="image">Image</div>
        <div class="details">Détails</div>
        <div class="actions">Actions</div>
    </div>

    <?php echo $articlesAff; ?>

    <div class="ajouter-article">
        <h2>Ajouter un nouvel article</h2>
        <form method="POST" action="/~inf2pj02/Controllers/AjoutController.php" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
                <label for="type">Type d'article :</label>
                <select name="type" id="type" required>
                    <option value="produit">Produit</option>
                    <option value="vetement">Vêtement</option>
                    <option value="galerie">Galerie</option>
                    <option value="evenement">Événement</option>
                    <option value="actu">Actualité</option>
                </select>
            </div>
            <div class="form-group">
                <label for="titre">Titre :</label>
                <input type="text" name="titre" id="titre" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea name="description" id="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="prix">Prix (si applicable) :</label>
                <input type="number" name="prix" id="prix" step="0.01">
            </div>
            <div class="form-group">
                <label for="picture">Image :</label>
                <input type="file" name="picture" id="picture" accept="image/*">
            </div>
            <button type="submit">Ajouter l'article</button>
        </form>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'Layout.php';
?>
