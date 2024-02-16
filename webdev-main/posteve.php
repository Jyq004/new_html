<?php

include 'dbcon.php';
include 'navbar.php';
if (isset($_POST["pbtn"])) {
    if (isset($_SESSION['id'])) {
        $mID = $_SESSION['id'];
        $_SESSION['id'] = $mID;
        $evename = $_POST['event_name'];
        $vn = $_POST['vn'];
        $tm = $_POST['tm'];
        $dt = $_POST['dt'];
        $esnum = $_POST['esnum'];
        $des = $_POST['desp'];

        $queryCountPs = "SELECT COUNT(ProposalID) as totalprop FROM `proposal`";
        $resultCountPs = $conn->query($queryCountPs);
        $rowCountPs = $resultCountPs->fetch_assoc();
        $totalprop = $rowCountPs['totalprop'];
        $psID = 'P' . ($totalprop + 1);

        $query= "INSERT INTO `proposal`(`ProposalID`, `MemberID`, `EventName`, `Venue`, `Time`, `Date`, `EstimatedNum`, `Status`, `Description`) VALUES ('$psID','$mID','$evename','$vn','$tm','$dt','$esnum','Pending','$des')";
        $result=mysqli_query($conn,$query);
        if($result){
            echo '<script>
            alert("Proposal sent, please kindly wait for admin approval");
            window.location.replace("event.php");
            </script>';
        }
    }else{
        echo '<script>
        alert("Please login as a member to join.");
        window.location.replace("login.php");
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
    <link rel="stylesheet" href="postevestyle.css">
</head>
<body>
    <div class="tt">
    <h2>Event Proposal Page</h2>
    </div>
    <div class="inform">
    <form action="" method="post">
        Event Name:<input type="text" name="event_name" class="input" required><br>
        Venue:<input type="text" name="vn" class="input" required><br>
        Time:<input type="time" name="tm" class="input" required><br>
        Date:<input type="date" name="dt" class="input" required><br>
        Estimated Number:<input type="number" name="esnum" class="input" required><br>
        Description:<input type="text" name="desp" class="input" required><br>
        <input type="submit" value='Send' name='pbtn' class="inputbtn">
    </form>
    </div>
</body>
</html>