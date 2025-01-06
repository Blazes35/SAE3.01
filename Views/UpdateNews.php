<?php 
$title = "Update News";
ob_start();
?>
<link rel="stylesheet" href="css/updateNews.css" />


<div class="container">
    <h1 class="titre">Modifier ou Supprimer une Actualité</h1>
    <p><?php echo $message; ?></p>
    <div class=form-container>
        <form class="formulaire" method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="idActualite" value="<?php echo htmlspecialchars($actu['idActualite']); ?>" />
            <input type="hidden" name="currentImg" value="<?php echo htmlspecialchars($actu['urlPhotoActualite']); ?>" />
            <input type="hidden" name="action" value="update" />
            <div>
                <label for="titreActualite">Titre de l'actualité</label>
                <input type="text" id="titreActualite" name="titreActualite" 
                    value="<?php echo htmlspecialchars($actu['titreActualite']); ?>" required />
            </div>
            <br>
            <div>
                <label for="descActualite">Description</label>
                <input type="text" id="descActualite" name="descActualite" 
                    value="<?php echo htmlspecialchars($actu['descActualite']); ?>" />
            </div>
            <br>
            <div>
                <label for="dateActualite">Date</label>
                <input type="text" id="dateActualite" name="dateActualite" 
                    value="<?php echo htmlspecialchars($actu['dateActualite']); ?>" required />
            </div>
            <br>
            <div>
                <label for="img">Image</label>
                <input type="file" id="img" name="img" accept="image/*" />
                <p>Image actuelle : <strong><?php echo htmlspecialchars($actu['urlPhotoActualite']); ?></strong></p>
                <img src="uploads/actu/<?php echo htmlspecialchars($actu['urlPhotoActualite']); ?>" 
                    alt="Image actuelle" style="max-width: 200px; height: auto;" />
            </div>
            <br>
            <button type="submit">Mettre à jour</button>
        </form>
        <br>
        <!-- Formulaire de suppression -->
        <form class="delete-button" method="POST" action="">
            <input type="hidden" name="idActualite" value="<?php echo htmlspecialchars($actu['idActualite']); ?>" />
            <input type="hidden" name="action" value="delete" />
            <button type="submit" style="background-color: red; color: white;">Supprimer l'actualité</button>
        </form>
    </div>
</div>
<?php
$content = ob_get_clean();
include 'LayoutAdmin.php';
?>