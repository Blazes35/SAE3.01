<?php

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

$userIdTPAgenda = '21B'; 

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

if (isset($urls[$userIdTPAgenda])) {
    $events = fetchEventsFromUrl($urls[$userIdTPAgenda]);
    
    usort($events, function ($a, $b) {
        return strtotime($a["DTSTART"]) - strtotime($b["DTSTART"]);
    });
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendrier</title>
    
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css" rel="stylesheet">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.15/index.global.min.js'></script>

    <script type="module" src="ical.js/dist/ical.js"></script>

    <style>
        #calendar {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

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
    
</body>
</html>
