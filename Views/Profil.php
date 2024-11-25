<?php
$title = 'Profil';
ob_start();
?>

<link rel="stylesheet" href="../css/profil.css"/>
        </div>
    </div>
</div>

    <h1>Profil</h1>
        <!-- <form action="?page=Login" method="post"> -->
            <div class="input-row">
                <section>
                    <p>Prénom</p>
                    <div class="input-group">
                        <input type="text" name="Prenom" value="Prénom" required>
                    </div>
                </section>
                <section>
                    <p>Nom</p>
                    <div class="input-group">
                        <input type="text" name="Nom" value="Nom" required>
                    </div>
                </section>
            </div>
            <div class="connexion">

            <hr>

            <hr>

            <div class="envoyer">
                <button type="submit" name="connect">Changer mot de passe</button>
            </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include 'Layout.php';
?>