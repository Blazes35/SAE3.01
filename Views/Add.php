<?php
$title ='Ajouter un article';
ob_start();
?>
link:kd
<script>
    function toggleFields() {
        // Initialisez tous les champs à false (masqué par défaut)
        const fields = {
            'desc-field': false,
            'price-field': false,
            'promo-field': false, 
            'qt-field': false, 
            'color-field': false, 
            'capacite-field': false, 
            'minRole-field': false, 
            'minGrade-field': false, 
            'lieu-field': false, 
            'date-field': false, 
            'contenuActu-field': false,
            'dateDebut-field': false,
            'dateFin-field': false,
            'conditionCode-field': false,
            'picture-field': false
        };

        // Obtenez le type d'article sélectionné
        const articleType = document.getElementById('article-select').value;

        // Configurez les champs en fonction du type d'article
        switch (articleType) {
            case 'vetement':
                fields['desc-field'] = true;
                fields['picture-field'] = true; // Montrer l'image
                fields['color-field'] = true;
                fields['price-field'] = true;
                fields['qt-field'] = true;
                break;
            case 'evenement':
                fields['desc-field'] = true;
                fields['picture-field'] = true; // Montrer l'image
                fields['capacite-field'] = true;
                fields['minRole-field'] = true;
                fields['minGrade-field'] = true;
                fields['lieu-field'] = true;
                fields['date-field'] = true;
                break;
            case 'actu':
                fields['desc-field'] = false; // Masquer le champ description
                fields['picture-field'] = true; // Montrer l'image
                fields['contenuActu-field'] = true;
                fields['date-field'] = true;
                break;
            case 'code':
                fields['promo-field'] = true;
                fields['dateDebut-field'] = true;
                fields['dateFin-field'] = true;
                fields['conditionCode-field'] = true;
                break;
            case 'produit':
                fields['desc-field'] = true;
                fields['picture-field'] = true; 
                fields['price-field'] = true;
                fields['qt-field'] = true;
                fields['promo-field'] = true;
                fields['conditionCode-field'] = true;
                break;
            case 'galerie' : 
                fields['picture-field'] = true;
            default:
                break;
        }

        // Appliquez les propriétés "hidden" à chaque champ
        for (const id in fields) {
            document.getElementById(id).hidden = !fields[id];
        }
    }
</script>

<form method="post" action="ajout.php" enctype="multipart/form-data">
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

    <label for="title">Titre</label>
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