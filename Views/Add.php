<?php
$title ='Ajouter un article';
ob_start();
?>
<script src="JS/Add.js"></script>
<link rel="stylesheet" href="css/ajout.css" />
<form class="addForm" method="post" action="/?page=Add" enctype="multipart/form-data">
    <label for="choice">Choisir le type d'article :</label>
    <select name="article" id="article-select" onchange="toggleFields()">
        <option value="">--Choisir un type d'article--</option>
        <option value="produit">Produit</option>
        <option value="galerie">Galerie</option>
        <option value="evenement">Evenement</option>
        <option value="vetement">Vetement</option>
        <option value="actu">Actualité</option>
        <option value="code">Code Promotionnel</option>
    </select>

    <div id="color-field" hidden>
        <label for="color">Couleur</label>
        <input type="text" name="color" id="color">
    </div>

    <label for="title2">Titre</label>
    <input type="text" name="title" id="title" required>

    <div id="desc-field">
    <label for="desc">Description</label>
    <input type="text" name="desc" id="desc">
    </div>

    <div id="picture-field">
    <label for="picture">Image</label>
    <input type="file" name="picture" id="picture">
    </div>

    <div id="price-field" hidden>
        <label for="price">Prix</label>
        <input type="text" name="price" id="price">
    </div>

    <div id="promo-field" hidden>
        <label for="pourcentCode">Pourcentage de réduction</label>
        <input type="number" step="0.01" name="pourcentCode" id="pourcentCode">
    </div>

    <div id="qt-field" hidden>
        <label for="qt">Quantité</label>
        <input type="text" name="qt" id="qt">
    </div>

    <div id="capacite-field" hidden>
        <label for="capacite">Capacité</label>
        <input type="number" name="capacite" id="capacite">
    </div>

    <div id="minRole-field" hidden>
        <label for="minRole">Role minimal</label>
        <input type="text" name="minRole" id="minRole">
    </div>

    <div id="minGrade-field" hidden>
        <label for="minGrade">Grade minimal</label>
        <input type="text" name="minGrade" id="minGrade">
    </div>

    <div id="lieu-field" hidden>
        <label for="lieu">Lieu</label>
        <input type="text" name="lieu" id="lieu">
    </div>

    <div id="date-field" hidden>
        <label for="date">Date</label>
        <input type="date" name="date" id="date">
    </div>

    <div id="contenuActu-field" hidden>
        <label for="descActualite">Description</label>
        <input type="text" name="descActualite" id="descActualite">
    </div>

    <div id="dateDebut-field" hidden>
        <label for="dateDebut">Date de début</label>
        <input type="date" name="dateDebut" id="dateDebut">
    </div>

    <div id="dateFin-field" hidden>
        <label for="dateFin">Date de fin</label>
        <input type="date" name="dateFin" id="dateFin">
    </div>

    <div id="conditionCode-field" hidden>
        <label for="conditionCode">Condition du code</label>
        <input type="text" name="conditionCode" id="conditionCode">
    </div>

    <button type="submit" name="action" value="add">Ajouter</button>
    <button type="submit" name="action" value="delete">Supprimer</button>
</form>

<?php
$content = ob_get_clean();
include 'LayoutAdmin.php';