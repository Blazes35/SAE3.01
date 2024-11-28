<?php
$title = "Modifier ou supprimer un événement";
ob_start();
?>

<h1>Modifier ou supprimer un événement</h1>
<p><?php echo $message; ?></p>

<?php if ($event): ?>
<form method="POST" action="" enctype="multipart/form-data">
    <input type="hidden" name="idEvent" value="<?php echo htmlspecialchars($event['idEvent']); ?>" />
    <input type="hidden" name="currentImg" value="<?php echo htmlspecialchars($event['imgEvent']); ?>" />
    <input type="hidden" name="action" value="update" />

    <div>
        <label for="titre">Nom de l'événement</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($event['titreEvent']); ?>" required />
    </div>
    <div>
        <label for="desc">Description</label>
        <input type="text" id="desc" name="desc" value="<?php echo htmlspecialchars($event['descEvent']); ?>" />
    </div>
    <div>
        <label for="price">Prix</label>
        <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($event['prixEvent']); ?>" required />
    </div>
    <div>
        <label for="capacite">Capacité</label>
        <input type="number" id="capacite" name="capacite" value="<?php echo htmlspecialchars($event['capaEvent']); ?>" required />
    </div>
    <div>
        <label for="minRole">Min rôle</label>
        <input type="number" id="minRole" name="minRole" value="<?php echo htmlspecialchars($event['minRoleEvent']); ?>" required min="0" max="4" />
    </div>
    <div>
        <label for="minGrade">Min grade</label>
        <input type="number" id="minGrade" name="minGrade" value="<?php echo htmlspecialchars($event['minGradeEvent']); ?>" required min="0" max="4" />
    </div>
    <div>
        <label for="img">Image</label>
        <input type="file" id="img" name="img" accept="image/*" />
        <p>Image actuelle : <strong><?php echo htmlspecialchars($event['imgEvent']); ?></strong></p>
        <img src="uploads/evenements/<?php echo htmlspecialchars($event['imgEvent']); ?>" alt="Image actuelle" style="max-width: 200px; height: auto;" />
    </div>
    <button type="submit">Mettre à jour</button>
</form>

<form method="POST" action="">
    <input type="hidden" name="idEvent" value="<?php echo htmlspecialchars($event['idEvent']); ?>" />
    <input type="hidden" name="action" value="delete" />
    <button type="submit" style="background-color: red; color: white;">Supprimer l'événement</button>
</form>
<?php else: ?>
<p>Événement introuvable.</p>
<?php endif; ?>

<?php
$content = ob_get_clean();
include 'Layout.php';
?>
