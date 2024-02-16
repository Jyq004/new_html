<?php
include 'dbcon.php';
include 'adnavbar.php';
if (isset($_SESSION['id'])) {
    $mID = $_SESSION['id'];
    $_SESSION['id'] = $mID;

    if (isset($_POST['dlbtn'])) {
        $propId = $_POST['prop_id'];
        $query = "UPDATE `proposal` SET `Status`='Approved' WHERE `ProposalID`='$propId'";
        $resultup = mysqli_query($conn, $query);
        if($resultup){
            echo '<script>
                    alert("Event Approve Successfully");
                    window.location.replace("adprop.php");
                    </script>';
            $pmID = $_POST['m_id'];
            $evenm = $_POST['evename'];
            $vn = $_POST['vn'];
            $tm = $_POST['tm'];
            $dt = $_POST['dt'];
            $esnum = $_POST['esnum'];
            $des = $_POST['desc'];
            $queryCountE = "SELECT COUNT(EventID) as totalE FROM `event`";
            $resultCountE = $conn->query($queryCountE);
            $rowCountE = $resultCountE->fetch_assoc();
            $totalE = $rowCountE['totalE'];
            $newEID = 'E' . ($totalE + 1);


            $sql = "SELECT EventID 
            FROM event 
            ORDER BY EventID DESC
            LIMIT 1;";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $ID = $row["ReportID"];
        $IDnum = str_replace("R", "", $ID);
        $INTIDnum = (int)$IDnum;
        $addID = $INTIDnum + 1;
        $newID = "R{$addID}";
    }





            $queryin="INSERT INTO `event`(`EventID`, `ProposalID`, `EventName`, `Venue`, `Time`, `Date`, `EstimatedNum`, `Desp`) VALUES ('$newEID','$propId','$evenm','$vn','$tm','$dt','$esnum','$des')";
            $resultqin=mysqli_query($conn,$queryin);

        }else {
            echo '<script>
            alert("Approve Failed");
            window.location.replace("adprop.php");
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
            <h2>Proposal Page</h2>
        </div>
        <p class=content>
            Guides on approving event:<br>
            1. Make sure that the event is legal and achievable<br>
            2. Event proposed should be relevant with help animal theme<br>
            3. Ensure that there is no schedule conflict between events <br>
            Example:Two event occuring at the same place and same time<br>
            <br>Note: Below are the proposal sent by members
        </p>
            <h3>Proposal List:</h3>
            <div id='evelist'>
            <?php
            $query = "SELECT * FROM proposal";
            $results = mysqli_query($conn, $query);

            if (mysqli_num_rows($results) > 0) {
                echo '<table border=1>
                    <tr>
                        <th>Proposal ID</th>
                        <th>Member ID</th>
                        <th>Event Name</th>
                        <th>Venue</th>
                        <th>Time</th>
                        <th>Date</th>
                        <th>Estimated People</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>';

                while ($row = mysqli_fetch_assoc($results)) {
                echo '<tr>
                        <td>' . $row['ProposalID'] . '</td>
                        <td>' . $row['MemberID'] . '</td>
                        <td>' . $row['EventName'] . '</td>
                        <td>' . $row['Venue'] . '</td>
                        <td>' . $row['Time'] . '</td>
                        <td>' . $row['Date'] . '</td>
                        <td>' . $row['EstimatedNum'] . '</td>
                        <td>' . $row['Status'] . '</td>
                        <td>' . $row['Description'] . '</td>
                        <td>';
                    echo '<form method="post" action="">
                            <input type="hidden" name="prop_id" value="' . $row['ProposalID'] . '">
                            <input type="hidden" name="m_id" value="' . $row['MemberID'] . '">
                            <input type="hidden" name="evename" value="' . $row['EventName'] . '">
                            <input type="hidden" name="vn" value="' . $row['Venue'] . '">
                            <input type="hidden" name="tm" value="' . $row['Time'] . '">
                            <input type="hidden" name="dt" value="' . $row['Date'] . '">
                            <input type="hidden" name="esnum" value="' . $row['EstimatedNum'] . '">
                            <input type="hidden" name="desc" value="' . $row['Description'] . '">
                            <input type="submit" value="Approve" name="dlbtn">
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

    <form id='rn' action="adeve.php" method="post">
        <input type="submit" value="Return" name="rbtn">
    </form>




    </body>
    </html>



