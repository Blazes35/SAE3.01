<?php 
session_name('BDE');
session_set_cookie_params(86400 * 30, "/");
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier</title>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="calendrier.css" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js'></script>
    <script type="module" src="ical.js/dist/ical.js"></script>
</head>
<body>
    <div class="menu">
        <div class="logo-theme">
            <img class="logo" src="./images/logo-sans-fond.png" />
            <div class="theme-claire">THÈME CLAIR</div>
        </div>
        <div class="compte">
            <span class="material-symbols-outlined">account_circle</span>
            <a href="compte.html" class="mon-compte" style="cursor: pointer;">MON COMPTE</a>
        </div>
        <div class="overlap-group">
            <div class="titre-de-page">
                <div class="overlap-group-3">
                    <a href="TableauBord.html" class="tableau" style="cursor: pointer;">TABLEAU DE BORD</a>
                    <a href="calendrier.php" class="calendrier" style="cursor: pointer;">CALENDRIER</a>
                    <a href="GestionProfilAdmin.php" class="profils" style="cursor: pointer;">GESTION PROFILS</a>
                    <a href="tresorie.php" class="tresorie" style="cursor: pointer;">TRÉSORERIE</a>
                    <a href="parametres.html" class="parametres" style="cursor: pointer;">PARAMÈTRES</a>
                    <a href="boutique_hugo.php" class="editer" style="cursor: pointer;">ÉDITER CONTENU</a>
                </div>
            </div>
        </div>
    </div>
    <div id="calendar"></div>

    <?php   
    $userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 0;
    $userName = isset($_SESSION['nom']) ? $_SESSION['nom'] : 'Invité'; 
    $userTp = isset($_SESSION['TP']) ? $_SESSION['TP'] : 'tp inconnu';

    $urls = [
        '11A' => 'http://planning.univ-lemans.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=282&projectId=7&calType=ical&nbWeeks=4',
        '11B' => 'http://planning.univ-lemans.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=567&projectId=7&calType=ical&nbWeeks=4',
        '12C' => 'http://planning.univ-lemans.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=861&projectId=7&calType=ical&nbWeeks=4',
        '12D' => 'http://planning.univ-lemans.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=861&projectId=7&calType=ical&nbWeeks=4',
        '21A' => 'http://planning.univ-lemans.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=2667&projectId=7&calType=ical&nbWeeks=4',
        '21B' => 'http://planning.univ-lemans.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=2668&projectId=7&calType=ical&nbWeeks=4',
        '22C' => 'http://planning.univ-lemans.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=3113&projectId=7&calType=ical&nbWeeks=4',
        '22D' => 'http://planning.univ-lemans.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=3115&projectId=7&calType=ical&nbWeeks=4',
        '31A' => 'http://planning.univ-lemans.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=5269&projectId=7&calType=ical&nbWeeks=4',
        '31B' => 'http://planning.univ-lemans.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=5419&projectId=7&calType=ical&nbWeeks=4',
        '32C' => 'http://planning.univ-lemans.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=6239&projectId=7&calType=ical&nbWeeks=4',
        '32D' => 'http://planning.univ-lemans.fr/jsp/custom/modules/plannings/anonymous_cal.jsp?resources=6241&projectId=7&calType=ical&nbWeeks=4'
    ];

    $userIdTPAgenda = $userTp;

    function fetchEventsFromUrl($url) {
        $ical = file_get_contents($url); 
        preg_match_all('/(BEGIN:VEVENT.*?END:VEVENT)/si', $ical, $result, PREG_PATTERN_ORDER);

        $icalarray = [];
        foreach ($result[0] as $eventData) {
            $tmpbyline = explode("\r\n", $eventData);
            $event = [];
            foreach ($tmpbyline as $item) {
                $tmpholderarray = explode(":", $item);
                if (count($tmpholderarray) > 1) {
                    $event[$tmpholderarray[0]] = $tmpholderarray[1];
                }
            }

            if (preg_match('/DESCRIPTION:(.*)END:VEVENT/si', $eventData, $regs)) {
                $event['DESCRIPTION'] = str_replace("  ", " ", str_replace("\r\n", "", $regs[1]));
            }

            if (isset($event['DTSTART']) && isset($event['DTEND'])) {
                $icalarray[] = $event;
            }
        }

        return $icalarray;
    }

    // Récupérer les cours depuis iCal
    $events = [];
    if (isset($urls[$userIdTPAgenda])) {
        $events = fetchEventsFromUrl($urls[$userIdTPAgenda]);
    }

    // Ajouter les événements depuis la base de données
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=inf2pj_02', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->query("SELECT titreEvent, descEvent, dateEvent, lieuEvent FROM EVENEMENT");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $events[] = [
                'SUMMARY' => $row['titreEvent'],
                'DESCRIPTION' => $row['descEvent'] . ' - Lieu : ' . $row['lieuEvent'],
                'DTSTART' => $row['dateEvent'] . 'T00:00:00',
            ];
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    // Trier les événements par date
    usort($events, function ($a, $b) {
        return strtotime($a["DTSTART"]) - strtotime($b["DTSTART"]);
    });
    ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridWeek',
                events: [
                    <?php
                        foreach ($events as $event) {
                            $eventdate = date('Y-m-d', strtotime($event['DTSTART']));
                            $eventTime = date('H:i', strtotime($event['DTSTART']));
                            $eventTitle = addslashes($event['SUMMARY']);
                            $eventDescription = addslashes($event['DESCRIPTION']);

                            echo "{ 
                                title: '$eventTitle', 
                                start: '$eventdate $eventTime', 
                                description: '$eventDescription' 
                            },";
                        }
                    ?>
                ]
            });

            calendar.render();
        });
    </script>

    <script>
        var userRole = <?php echo json_encode($userRole); ?>;
        var userName = <?php echo json_encode($userName); ?>;
        var userTp = <?php echo json_encode($userTp); ?>;

        console.log("Role de l'utilisateur : " + userRole);
        console.log("Nom de l'utilisateur : " + userName);
        console.log("Tp de l'utilisateur : " + userTp);
        </script>


</body>
</html>
