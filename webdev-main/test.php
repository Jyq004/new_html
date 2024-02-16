<?php

include 'dbcon.php';
include 'adnavbar.php';
if (isset($_SESSION['id'])) {
    $mID = $_SESSION['id'];
    $_SESSION['id'] = $mID;

    if (isset($_POST['dlbtn'])) {
        $eventId = $_POST['event_id'];
        $query = "DELETE FROM `event` WHERE EventID = '$eventId'";
        $resultdel = mysqli_query($conn, $query);
        if($resultdel){
            echo '<script>
                    alert("Event Deleted Successfully");
                    window.location.replace("adeve.php");
                    </script>';
        }else {
            echo '<script>
            alert("Delete Failed");
            window.location.replace("adeve.php");
            </script>';
        }
    
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="evestyle.css">
    </head>
    <body>
    <div class="bigwrap">
        <div class="wrapper">
            <h2>Event Page</h2>
        </div>
        <p class=content>
Participating in animal care events offers a myriad of benefits for both individuals and communities. Beyond the immediate impact of raising awareness about animal welfare issues, these events provide invaluable educational opportunities. Workshops and hands-on experiences foster a deeper understanding of responsible pet ownership, conservation, and the challenges faced by various species. Moreover, joining such events builds a community of like-minded individuals, encouraging collaboration and lasting friendships. The emotional well-being derived from caring for animals and the development of advocacy skills further contribute to personal growth. Importantly, these gatherings serve as platforms for networking with professionals, creating pathways to potential careers in animal-related fields. By actively engaging in events dedicated to caring for animals, participants fulfill a social responsibility, collectively advocating for legislative changes that enhance the protection and well-being of all living beings. In essence, these events not only make a positive impact on animals but also enrich the lives of those involved.</p>
            <h3>Event List:</h3>
            <div id='evelist'>
            <?php
            $query = "SELECT * FROM event";
            $results = mysqli_query($conn, $query);

            if (mysqli_num_rows($results) > 0) {
                echo '<table border=1>
                    <tr>
                        <th>Event</th>
                        <th>Venue</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Estimated People</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>';

                while ($row = mysqli_fetch_assoc($results)) {
                echo '<tr>
                        <td>' . $row['EventName'] . '</td>
                        <td>' . $row['Venue'] . '</td>
                        <td>' . $row['Time'] . '</td>
                        <td>' . $row['Date'] . '</td>
                        <td>' . $row['EstimatedNum'] . '</td>
                        <td>' . $row['Desp'] . '</td>
                        <td>';
                    echo '<form method="post" action="">
                            <input type="hidden" name="event_id" value="' . $row['EventID'] . '">
                            <input type="submit" value="Delete" name="dlbtn">
                        </form>';
                } 

                echo '</td>
                    </tr>';
            }
                echo '</table>';
            } else {
                echo 'No events currently';
            }
            
            ?>
        </div>
    </div>
    <form id='rn' action="advol.php" method="post">
        <input type="submit" value="Return" name="rbtn">
    </form>



    </body>
    </html>



