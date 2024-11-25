<?php
$title = 'Profil';
ob_start();
?>

<link rel="stylesheet" href="../css/profil.css"/>
        </div>
    </div>
</div>

<div class="Profile">
    <div class="titreProfil">
        <p>Page Personnelle</p>
    </div>
    <div class="info">
        <!--<img src=""-->
        <div class="pn">
            <p><?php
            $sql = "SELECT nomUser, prenomUser FROM UTILISATEUR WHERE adrMailUser=:email";
            $stmt = $c->prepare($sql);
            $stmt->bindParam(':id', $_SESSION['email'], PDO::PARAM_STR);
            $stmt->execute();
            ?></p>
            
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'Layout.php';
?>