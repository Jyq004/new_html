<?php

include 'dbcon.php';
include 'navbar.php';
if (isset($_SESSION['id'])) {
    $mID = $_SESSION['id'];
    $_SESSION['id'] = $mID;
    $mID = $_SESSION['id'];
    $fvidquery="SELECT * from volunteer where MemberID='$mID'";
    $resvid= mysqli_query($conn,$fvidquery);
    if(mysqli_num_rows($resvid)==1){
    $rowfvid= mysqli_fetch_assoc($resvid);
    $volunteerID = $rowfvid['VolunteerID'];
    }else{
    $volunteerID='';
    }


    if (isset($_POST['jnbtn'])) {
        $query = "SELECT VolunteerID FROM volunteer WHERE MemberID='$mID'";
        $resultsinSel = mysqli_query($conn, $query);

        // condition where already have VolunteerID in the database
        if (mysqli_num_rows($resultsinSel) == 1) {
            $rowforVolID = mysqli_fetch_assoc($resultsinSel);
            $volunteerID = $rowforVolID['VolunteerID'];

            // Check if the user has already joined the event
            $eventId = $_POST['event_id'];
            $checkJoinedQuery = "SELECT * FROM ev_vol WHERE VolunteerID='$volunteerID' AND EventID='$eventId'";
            $resultCheckJoined = mysqli_query($conn, $checkJoinedQuery);

            //if havent join
            if (mysqli_num_rows($resultCheckJoined) == 0) {
                // Generate new Ev_volID
                $queryCountEv = "SELECT COUNT(Ev_volID) as totalEvVolunteer FROM `Ev_vol`";
                $resultCountEv = $conn->query($queryCountEv);
                $rowCountEv = $resultCountEv->fetch_assoc();
                $totalEvVolunteer = $rowCountEv['totalEvVolunteer'];
                $newEvID = 'Ev' . ($totalEvVolunteer + 1);

                // Insert into ev_vol table
                $queryint = "INSERT INTO `ev_vol`(`Ev_volID`, `VolunteerID`, `EventID`) VALUES ('$newEvID','$volunteerID','$eventId')";
                if (mysqli_query($conn, $queryint)) {
                    echo '<script>
                            alert("Registered Successfully");
                            window.location.replace("event.php");
                        </script>';
                        //Counting how many time volunteer job been done 
                        $queryEventCount = "SELECT COUNT(VolunteerID) as totalVolunteerDone FROM `ev_vol` WHERE VolunteerID='$volunteerID'";
                        $resultEventCount = $conn->query($queryEventCount);
                        $rowEventCount = $resultEventCount->fetch_assoc();
                        $totalEventDone = $rowEventCount['totalVolunteerDone'];
                
                        // Update Total Event Join
                        $upquery = "UPDATE `volunteer` SET `EventNum`='$totalEventDone' WHERE VolunteerID='$volunteerID'";
                        if (mysqli_query($conn, $upquery)) {
                            echo '<script>
                                    alert("Update Successfully");
                                    window.location.replace("event.php");
                                    </script>';
                            exit;
                        } else {
                            echo 'Update Failed, please try again';
                        }
                    exit;
                } else {
                    echo 'Register Failed, please try again';
                }
            } else {
                echo '<script>
                        alert("You have already joined this event");
                        window.location.replace("event.php");
                    </script>';
                exit;
            }

            
        } else {
            // condition for not registered volunteer

            //Generate volID 
            $queryCount = "SELECT COUNT(VolunteerID) as totalVolunteer FROM `volunteer`";
            $resultCount = $conn->query($queryCount);
            $rowCount = $resultCount->fetch_assoc();
            $totalVolunteer = $rowCount['totalVolunteer'];
            $volunteerID = 'V' . ($totalVolunteer + 1);

            // Insert into volunteer table
            $query = "INSERT INTO `volunteer`(`VolunteerID`, `MemberID`, `EventNum`, `ShelterNum`) VALUES ('$volunteerID','$mID','1','0')";
            if (mysqli_query($conn, $query)) {
                //Generate new EvID
                $queryCountEv = "SELECT COUNT(Ev_volID) as totalEvVolunteer FROM `Ev_vol`";
                $resultCountEv = $conn->query($queryCountEv);
                $rowCountEv = $resultCountEv->fetch_assoc();
                $totalEvVolunteer = $rowCountEv['totalEvVolunteer'];
                $newEvID = 'Ev' . ($totalEvVolunteer + 1);

                // Insert into ev_vol table based on the event clicked
                $eventId = $_POST['event_id'];
                $queryint = "INSERT INTO `ev_vol`(`Ev_volID`, `VolunteerID`, `EventID`) VALUES ('$newEvID','$volunteerID','$eventId')";
                if (mysqli_query($conn, $queryint)) {
                    echo '<script>
                            alert("Registered Successfully");
                            window.location.replace("event.php");
                        </script>';
                        $_SESSION['vID']=$volunteerID;
                    exit;
                } else {
                    echo 'Register Failed, please try again';
                }
            } else {
                echo 'Register Failed, please try again';
            }
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

        <form action="posteve.php">
            <input type="submit" value="Post Event" name="peve" class='pevebtn'>
        </form>

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

                // Check if the user has already joined the event
                $eventIdbtn = $row['EventID'];
                $checkJoinedQuery = "SELECT * FROM ev_vol WHERE VolunteerID='$volunteerID' AND EventID='$eventIdbtn'";
                $resultCheckJoined = mysqli_query($conn, $checkJoinedQuery);

                if (mysqli_num_rows($resultCheckJoined) == 0) {
                    echo '<form method="post" action="">
                            <input type="hidden" name="event_id" value="' . $row['EventID'] . '">
                            <input type="submit" value="Join" name="jnbtn">
                        </form>';
                } else {
                    echo '<button type="button" disabled>Joined</button>';
                    
                }

                echo '</td>
                    </tr>';
            }
                echo '</table>';
                $_SESSION['id'] = $mID;
            } else {
                echo 'No events currently';
            }
            ?>
        </div>
    </div>
    <form id='rn' action="volunteer.php" method="post">
        <input type="submit" value="Return" name="rbtn">
    </form>



    </body>
    </html>

    <?php

}else{

    if (isset($_POST['logbtn'])) {
        echo '<script>
        alert("Please login as a member to join.");
        window.location.replace("login.php");
        </script>';
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
        <form action="posteve.php">
            <input type="submit" value="Post Event" name="peve" class='pevebtn'>
        </form>
        
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
                        <td> <form method="post" action="">
                            <input type="submit" value="Join" name="logbtn">
                        </form>';

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
    <form id='rn' action="volunteer.php" method="post">
        <input type="submit" value="Return" name="rbtn">
    </form>
    <?php
}

mysqli_close($conn);
?>

