<?php
include 'dbcon.php';
include 'adnavbar.php';
if (isset($_POST['apbtn'])) {
    $blogtup=$_POST['bid'];
    $upquery="UPDATE `blog` SET `Status`='Approved' WHERE `BlogID`='$blogtup'";
    if (mysqli_query($conn, $upquery)) {
        echo '<script>
                alert("Update Successful");
                window.location.replace("adblog.php");
                </script>';
    }else {
        echo '<script>
                alert("Update failed");
                window.location.replace("adblog.php");
                </script>';
    }
}

if (isset($_POST['rjbtn'])) {
    $blogtup=$_POST['bid'];
    $upquery="DELETE FROM `blog` WHERE `BlogID`='$blogtup'";
    if (mysqli_query($conn, $upquery)) {
        echo '<script>
                alert("Successfully deleted");
                window.location.replace("adblog.php");
                </script>';
    }else {
        echo '<script>
                alert("Failed to delete");
                window.location.replace("adblog.php");
                </script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="blogcss.css">
    <title>Document</title>
</head>
<body>
    <h2 class="ptt">Admin Blog Page</h2>
<div class="wrapbox">
<?php
include 'dbcon.php';
$query = "SELECT * FROM blog Inner join member on member.MemberID = blog.MemberID where Status='Pending' ";
$results = mysqli_query($conn, $query);

if (mysqli_num_rows($results) > 0) {
    while ($row = mysqli_fetch_assoc($results)) {
        echo '<div class=wrapblog>';
        echo '<p class="bid"><strong>BlogID:</strong> ' . $row['BlogID'] . '</p>';
        echo '<div class=upprofile>';
        echo '<div class="icon">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['ProfilePic']) . '">';
        echo '</div>';
        echo '<div class="nnd"';
        echo '<p><strong>Author:</strong> ' . $row['Name'] . '</p>';
        echo '<p><strong>DateTime:</strong> ' . $row['Date'] . '</p>';
        echo '</div>';
        echo '</div>';
        echo '<div class="ess"';
        echo '<p><strong>Title:</strong> ' . $row['Title'] . '</p>';
        echo '<p><strong>Content:</strong> ' . $row['Content'] . '</p>';
        echo '</div>';
        echo '<p><strong>Status:</strong> ' . $row['Status'] . '</p>';
        echo '<p><strong>Picture:</strong></p>';
            echo '<div class=imagebox>';
            echo '<img src="data:image/jpg;charset=utf8;base64,' . base64_encode($row['B_pic']) . '" style="width: 600px; height: 400px;" />';
            echo '</div>';
            echo '<div class="btnset">';
            echo '<form method="post" action="">
                            <input type="hidden" name="bid" value="' . $row['BlogID'] . '">
                            <input type="submit" value="Approve" name="apbtn">
                            <input type="submit" value="Reject" name="rjbtn">
                        </form>';
            echo '</div>';
        echo '</div>';

    }

    echo '</div>';
} else {
    echo '<p class="status error">No blogs found...</p>';
}

mysqli_close($conn);
?>
</div>

</body>
</html>
