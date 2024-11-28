<?php 
$title = 'Mise à jour de l evenement';
ob_start();
?>

<link rel="stylesheet" href="css/updateEvent.css"/>
</div>
    </div>
</div>

<div class="product-event">
        <h1>Mise à jour de l'evenement</h1>
        
        <div class="form-container">
        <div class="formulaire">
            <form method="POST" action="/?page=UpdateEvent" enctype="multipart/form-data">
                <input type="hidden" name="idEvent" value="<?php echo htmlspecialchars(intval($_POST['id'])) ?>" />
                <input type="hidden" name="currentImg" value="<?php echo htmlspecialchars($event['imgEvent']) ?>" />
                <div>
                    <label for="titre">Nom de l\'événement</label>
                    <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($event['titreEvent'])  ?>" required />
                </div>
                <br>
                <div>
                    <label for="desc">Description</label>
                    <input type="text" id="desc" name="desc" value="<?php echo htmlspecialchars($event['descEvent'])  ?>" />
                </div>
                <br>
                <div>
                    <label for="price">Prix</label>
                    <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($event['prixEvent'])  ?>" required />
                </div>
                <br>
                <div>
                    <label for="capacite">Capacité</label>
                    <input type="number" id="capacite" name="capacite" value="<?php echo htmlspecialchars($event['capaEvent'])  ?>" required />
                </div>
                <br>
                <div>
                    <label for="minRole">Min rôle</label>
                    <input type="number" id="minRole" name="minRole" value="<?php echo htmlspecialchars($event['minRoleEvent']) ?>" required min="0" max="4" />
                </div>
                <br>
                <div>
                    <label for="minGrade">Min grade</label>
                    <input type="number" id="minGrade" name="minGrade" value="<?php echo htmlspecialchars($event['minGradeEvent']) ?>" required min="0" max="4" />
                </div>
                <br>
                <div>
                    <label for="img">Image</label>
                    <input type="file" id="img" name="img" accept="image/*" />
                    <p>Image actuelle : <strong> <?php echo htmlspecialchars($event['imgEvent'])?> </strong></p>
                    <img src="uploads/evenements/ <?php echo htmlspecialchars($event['imgEvent']) ?>" alt="Image actuelle" style="max-width: 200px; height: auto;" />
                </div>
                <br>
                <button type="submit" name="updateEvent">Mettre à jour</button>
            </form>
            <br>
            <form method="POST" action="">
                <input type="hidden" name="idEvent" value="<?php echo htmlspecialchars($event['idEvent']) ?>" />
                <button type="submit" name="action" value="delete" style="background-color: red; color: white;">Supprimer l\'événement</button>
            </form>
            </div>
        </div>
    </div>

<?php
$content = ob_get_clean();
include 'LayoutAdmin.php';
?>