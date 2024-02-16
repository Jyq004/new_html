<?php
include 'dbcon.php';
include 'adnavbar.php';
if(isset($_POST['apbtn'])){
    $svid = $_POST['sv_id'];
    $upquery = "UPDATE `shel_vol` SET `Status`='Approved' WHERE `Shel_volID`='$svid'";
    $upres=mysqli_query($conn,$upquery);
    if ($upquery){
        echo '<script>
        alert("Update Successfully");
        window.location.replace("adshel.php");
    </script>';
    }else {
        echo '<script>
        alert("Update unsuccessfully");
        window.location.replace("adshel.php");
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
    <link rel="stylesheet" href="adshel.css">
</head>
<body>
    <h2>Shelter Schedule Approval</h2>

    <?php

$query = "SELECT * FROM shel_vol where Status='Pending'";
$results = mysqli_query($conn, $query);

if (mysqli_num_rows($results) > 0) {
    echo '<table border=1>
        <tr>
            <th>SvID</th>
            <th>VolunteerID</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Status</th>
            <th>Request</th>
        </tr>';

    while ($row = mysqli_fetch_assoc($results)) {
    echo '<tr>
            <td>' . $row['Shel_volID'] . '</td>
            <td>' . $row['VolunteerID'] . '</td>
            <td>' . $row['Date'] . '</td>
            <td>' . $row['Start_time'] . '</td>
            <td>' . $row['End_time'] . '</td>
            <td>' . $row['Status'] . '</td>
            <td>';
            echo '<form method="post" action="">
                            <input type="hidden" name="sv_id" value="' . $row['Shel_volID'] . '">
                            <input type="submit" value="Approve" name="apbtn">
                        </form>';
    echo '</td>
        </tr>';
}
    echo '</table>';

} else {
    echo 'No request for now';
}
mysqli_close($conn);
?>


</body>
</html>