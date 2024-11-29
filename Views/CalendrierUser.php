<?php
$title = "CalendrierUser";
ob_start();
?>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="calendrierUser.css" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js"></script>

<link rel="stylesheet" href="css/CalendrierUser.css">
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="title">Calendrier</h1>
    <div id="calendar"></div>
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
    </div>

    <script>
        var userRole = <?php echo json_encode($userRole); ?>;
        var userName = <?php echo json_encode($userName); ?>;
        var TP = <?php echo json_encode($TP); ?>;

        console.log("Role de l'utilisateur : " + userRole);
        console.log("Nom de l'utilisateur : " + userName);
        console.log("TP de l'utilisateur : " + TP);
    </script>
<?php
$content = ob_get_clean();
include 'Layout.php';
?>