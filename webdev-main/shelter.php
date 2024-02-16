<?php
include 'dbcon.php';
include 'navbar.php';

if (isset($_SESSION['id'])) {
    $mID = $_SESSION['id'];
    $volunteerID = $_SESSION['vID'];
    $_SESSION['id'] = $mID;


    if(isset($_POST['jnbtn'])){
        $dt=$_POST['date'];
        $st=$_POST['stime'];
        $et=$_POST['etime'];
        $startTime = new DateTime($st);
        $endTime = new DateTime($et);

        if ($startTime < $endTime) {
            $query = "SELECT VolunteerID FROM volunteer WHERE MemberID='$mID'";
            $resultsinSel = mysqli_query($conn, $query);

            // condition where already have VolunteerID in the main vol database
            if (mysqli_num_rows($resultsinSel) == 1) {
                $rowforVolID = mysqli_fetch_assoc($resultsinSel);
                $volunteerID = $rowforVolID['VolunteerID'];
                    //Generate a new SvID 
                    $queryCount = "SELECT COUNT(Shel_volID) as totalshelvol FROM `shel_vol`";
                    $resultCount = $conn->query($queryCount);
                    $row = $resultCount->fetch_assoc();
                    $totalshelvol = $row['totalshelvol'];
                    $newshelID = 'Sv' . ($totalshelvol + 1);

                    //insert into shel table
                    $query = "INSERT INTO `shel_vol`(`Shel_volID`, `VolunteerID`, `Date`, `Start_time`, `End_time`, `Status`) VALUES ('$newshelID','$volunteerID','$dt','$st','$et','Pending')";
                    if(mysqli_query($conn, $query)){
                        echo '<script>
                                alert("Registered Successfully");
                                window.location.replace("shelter.php");
                            </script>';
                    }else{
                        echo 'Register Failed please try again';
                    }
            }else{
                //Generate new VolID
                $queryCount = "SELECT COUNT(VolunteerID) as totalVolunteer FROM `volunteer`";
                $resultCount = $conn->query($queryCount);
                $rowCount = $resultCount->fetch_assoc();
                $totalVolunteer = $rowCount['totalVolunteer'];
                $volunteerID = 'V' . ($totalVolunteer + 1);

                // Insert into volunteer table
                $query = "INSERT INTO `volunteer`(`VolunteerID`, `MemberID`, `EventNum`, `ShelterNum`) VALUES ('$volunteerID','$mID','0','0')";
                if (mysqli_query($conn, $query)) {
                    //Generate new SvID
                    $queryCountSv = "SELECT COUNT(Shel_volID) as totalSv FROM `Shel_vol`";
                    $resultCountSv = $conn->query($queryCountSv);
                    $rowCountSv = $resultCountSv->fetch_assoc();
                    $totalSv = $rowCountSv['totalSv'];
                    $newshelID = 'Sv' . ($totalSv + 1);

                    // Insert into shel table
                    $queryint = "INSERT INTO `shel_vol`(`Shel_volID`, `VolunteerID`, `Date`, `Start_time`, `End_time`, `Status`) VALUES ('$newshelID','$volunteerID','$dt','$st','$et','Pending')";
                    if (mysqli_query($conn, $queryint)) {
                        echo '<script>
                                alert("Registered Successfully");
                                window.location.replace("shelter.php");
                            </script>';
                            $_SESSION['vID']=$volunteerID;
                        exit;
                    }
                }
            } 
        } else {
            echo '<script>
            alert("End Time should not be ealier than Start Time");
            window.location.replace("shelter.php");
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
    <link rel="stylesheet" href="shelstyle.css">
</head>
<body>
    <h2>Help out the Shelter Page</h2>
    <div class="cont">
    <?php
    $query = "SELECT * FROM shel_vol where volunteerID='$volunteerID'";
    $results = mysqli_query($conn, $query);

    if (mysqli_num_rows($results) > 0) {
        echo '<table border=1>
            <tr>
                <th>SvID</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
            </tr>';

        while ($row = mysqli_fetch_assoc($results)) {
            echo '<tr>
                    <td>' . $row['Shel_volID'] . '</td>
                    <td>' . $row['Date'] . '</td>
                    <td>' . $row['Start_time'] . '</td>
                    <td>' . $row['End_time'] . '</td>
                    <td>' . $row['Status'] . '</td>
                </tr>';
        }
        echo '</table>';
    } else {
        echo "No schedule has been made";
    }
    ?>
    </div>


    <h3>Note: All the request made need to wait for admin approval.</h3>
    <form class='formcont' action="" method='post'>
    Date: <input type=date name='date' required> <br>
    Start Time:<input type=time name='stime' required> <br>
    End Time: <input type=time name='etime' required> <br>
    <input type=submit value='Book' name='jnbtn'> 
    </form>

    <div class='tdl'>
    <h2>Pet Shelter Volunteer Tasks</h2>

    <ol>
        <li>Morning Routine:
            <ol>
                <li>Greet the animals and check their well-being.</li>
                <li>Clean and refill water bowls.</li>
                <li>Provide fresh bedding or clean kennels/cages.</li>
            </ol>
        </li>

        <li>Feeding:
            <ol>
                <li>Prepare and distribute meals according to the feeding schedule.</li>
                <li>Monitor the animals' eating habits and report any concerns to the staff.</li>
            </ol>
        </li>

        <li>Exercise and Playtime:
            <ol>
                <li>Take dogs for walks or playtime in designated areas.</li>
                <li>Engage in interactive play with cats, using toys and socializing.</li>
            </ol>
        </li>

        <li>Basic Training:
            <ol>
                <li>Work on basic commands with dogs (sit, stay, etc.) to improve their adoptability.</li>
                <li>Use positive reinforcement techniques to encourage good behavior.</li>
            </ol>
        </li>

        <li>Grooming:
            <ol>
                <li>Brush and groom animals to keep them clean and healthy.</li>
                <li>Assist with nail trimming and other grooming tasks.</li>
            </ol>
        </li>


        <li>Socialization:
            <ol>
                <li>Spend quality time interacting with animals to improve their social skills.</li>
                <li>Provide comfort and companionship to animals in need.</li>
            </ol>
        </li>

        <li>Cleaning and Maintenance:
            <ol>
                <li>Clean kennels, cages, and common areas regularly.</li>
                <li>Dispose of waste properly and maintain a sanitary environment.</li>
            </ol>
        </li>

        <li>Administrative Tasks:
            <ol>
                <li>Assist with paperwork, such as updating animal profiles and records.</li>
                <li>Answer phones and provide information to potential adopters.</li>
            </ol>
        </li>

        <li>Event Support:
            <ol>
                <li>Help organize and participate in adoption events or fundraisers.</li>
                <li>Assist in showcasing animals and promoting adoptions.</li>
            </ol>
        </li>

        <li>Education and Outreach:
            <ol>
                <li>Provide information to visitors about responsible pet ownership.</li>
                <li>Share knowledge about specific breeds and individual animals.</li>
            </ol>
        </li>
    </ol>
    </div>


    <form class='rform' action="volunteer.php" method="post">
        <input type="submit" value='Return' name='rbtn'>
    </form>




</body>


<?php
}else{
    if (isset($_POST['logbtn'])) {
        echo '<script>
        alert("Please login as a member to book.");
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
        <link rel="stylesheet" href="shelstyle.css">
    </head>
    <body>
        <h2>Help out the Shelter Page</h2>
        <h3>Note: All the request made need to wait for admin approval.</h3>
        <form class='formcont' action="" method='post'>
        Date: <input type=date name='date'> <br>
        Start Time:<input type=time name='stime'> <br>
        End Time: <input type=time name='etime'> <br>
        <input type=submit value='Book' name='logbtn'> 
        </form>

        <div class='tdl'>
        <h2>Pet Shelter Volunteer Tasks</h2>

<ol>
    <li>Morning Routine:
        <ol>
            <li>Greet the animals and check their well-being.</li>
            <li>Clean and refill water bowls.</li>
            <li>Provide fresh bedding or clean kennels/cages.</li>
        </ol>
    </li>

    <li>Feeding:
        <ol>
            <li>Prepare and distribute meals according to the feeding schedule.</li>
            <li>Monitor the animals' eating habits and report any concerns to the staff.</li>
        </ol>
    </li>

    <li>Exercise and Playtime:
        <ol>
            <li>Take dogs for walks or playtime in designated areas.</li>
            <li>Engage in interactive play with cats, using toys and socializing.</li>
        </ol>
    </li>

    <li>Basic Training:
        <ol>
            <li>Work on basic commands with dogs (sit, stay, etc.) to improve their adoptability.</li>
            <li>Use positive reinforcement techniques to encourage good behavior.</li>
        </ol>
    </li>

    <li>Grooming:
        <ol>
            <li>Brush and groom animals to keep them clean and healthy.</li>
            <li>Assist with nail trimming and other grooming tasks.</li>
        </ol>
    </li>

    <li>Socialization:
        <ol>
            <li>Spend quality time interacting with animals to improve their social skills.</li>
            <li>Provide comfort and companionship to animals in need.</li>
        </ol>
    </li>

    <li>Cleaning and Maintenance:
        <ol>
            <li>Clean kennels, cages, and common areas regularly.</li>
            <li>Dispose of waste properly and maintain a sanitary environment.</li>
        </ol>
    </li>

    <li>Administrative Tasks:
        <ol>
            <li>Assist with paperwork, such as updating animal profiles and records.</li>
            <li>Answer phones and provide information to potential adopters.</li>
        </ol>
    </li>

    <li>Event Support:
        <ol>
            <li>Help organize and participate in adoption events or fundraisers.</li>
            <li>Assist in showcasing animals and promoting adoptions.</li>
        </ol>
    </li>

    <li>Education and Outreach:
        <ol>
            <li>Provide information to visitors about responsible pet ownership.</li>
            <li>Share knowledge about specific breeds and individual animals.</li>
        </ol>
    </li>
</ol>
    </div>


    <form class='rform' action="volunteer.php" method="post">
        <input type="submit" value='Return' name='rbtn'>
    </form>
    </body>
    <?php
}


mysqli_close($conn);
?>
</html>