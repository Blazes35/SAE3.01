<?php
require_once 'Models/NewsModel.php';
$model = new NewsModel();
$actus =$model->getNews();
$actuAff = '';

if (isset($_SESSION['id'])) {
    $userRole = $_SESSION['role'];
    $userName = $_SESSION['nom'];
}

// Echo JavaScript to log the $_SESSION variable
echo '<script>
    console.log(' . json_encode($_SESSION) . ');
    console.log("2");
</script>';

foreach ($actus as $actu) {
    $actuAff .= '
<div class="container">
    <div class="actu-card">
        <div class="actu-card-in">

            <div class="actu-img">
                <img src="uploads/actu/' . htmlspecialchars($actu['urlPhotoActualite']) . '" 
                    alt="' . htmlspecialchars($actu['titreActualite']) . '" />
            </div>
        </div> 

        <div class="actu-card-in"> 
            <div class="detail">
                <p class="titre">' . htmlspecialchars($actu['titreActualite']) . '</p>
                <p class="contenu">' . htmlspecialchars($actu['descActualite']) . '</p>
                <p class="date">' . htmlspecialchars($actu['dateActualite']) . '</p>';
                
                if ( isset($userRole) and $userRole <=3) {
                    $actuAff .= "
                    <form action='?page=UpdateNews' method='post'>
                        <input type='hidden' name='adminPanel' value='1'>
                        <input type='hidden' name='idActualite' value=" . $actu['idActualite'] . " />
                        <button type='submit' name='update' class='settings'>
                                <span class='material-symbols-outlined'>settings</span>
                                <p id='probleme'>Parametrer</p>
                        </button>
                    </form>";
                }

    $actuAff .= '</div></div></div></div>';
}
    

include 'Views/News.php'; 

?>