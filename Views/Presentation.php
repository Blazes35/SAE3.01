<?php
$title = 'Presentation';
ob_start();
?>

<link rel="stylesheet" href="css/presentation.css"/>

<div class="overlap-group-4">
                <div>ADIIL</div>
                <div class="ligne"></div>
                <div class="qui-sommes-nous-title"> QUI SOMMES-NOUS</div>
            </div>
                <div class="overlap-group-5">
                <div class="sous-titre">ASSOCIATION DÉPARTEMENT INFORMATIQUE DE L'INSTITUTION DE LAVAL</div>
        </div>
    </div>
    </div>
</div>
<div class="box-2">
    <div class="texte-01">01</div>
    <div class="ligne-2"></div>
    <div>
    <p class="presentation">Présentation</p>
    <p class="p1">Bienvenue dans l'univers vibrant de notre 
                    association étudiante universitaire dédiée à l'épanouissement
                    de chacun de ses membres ! Nous sommes un groupe dynamique d'étudiants
                    passionnés par la création et le développement numérique. Nous cherchons un épanouissement
                    au sein de notre campus.
    </p>
</div>
</div>
<div class="box-3">
    <div>
    <p class="presentation-2">Que faisons-nous</p>
    <p class="p2">Nous organisons régulièrement une multitude d'événements, des fêtes thématiques à l’informatique, en passant par des compétitions de code palpitantes et des ateliers de développement personnel. Ces événements sont conçus pour favoriser l'échange d'idées, le renforcement des compétences, et surtout, le plaisir et le bien-être de chacun.
    </p>
    </div>
    <div class="ligne-3"></div>
    <div class="texte-02">02</div>
</div>
<div class="box-4">
    <div class="texte-03">03</div>
    <div class="ligne-4"></div>
    <div>
    <p class="presentation-3">Pourquoi nous rejoindre</p>
    <p class="p3">En rejoignant notre association, vous aurez l'opportunité de rencontrer des personnes partageant les mêmes idées, de développer de nouvelles compétences, et de contribuer positivement à la vie étudiante sur notre campus. Nous croyons en la force du collectif et en l'importance de créer des liens durables qui dépassent les salles de classe.
    </p>
</div>
</div>

<div class="box-6">
<p class="presentation-6">Les conditions d'adhésions au BDE</p>
    <p class="p6">Afin de rejoindre notre association étudiante, vous devez posséder une adresse mail, être dans un groupe TP parmis <br>
    ceux qui composent le BUT Informatique. Ainsi vous pourrez participer à des événements, acheter des produits, consulter les <br>
    actualités. Mais aussi nous proposons 3 grades qui apportent chacun des avantages.</p>
</div>

<?php
if(!isset($_SESSION['id'])){
    echo $rejoinsNous ;
}
$content = ob_get_clean();
include 'Layout.php';
?>