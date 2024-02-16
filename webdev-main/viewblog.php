<?php
include 'dbcon.php';
include 'navbar.php';

if (isset($_SESSION['id'])) {
    $mID = $_SESSION['id'];
    $_SESSION['id'] = $mID;

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
    <h2 class="ptt">Blog Page</h2>
    <form id='pbtn' action="inblog.php">
        <input type="submit" value='Post Blog' name='pb'>
    </form>
<?php


$query = "SELECT * FROM blog Inner join member on member.MemberID = blog.MemberID  where Status='Approved' ";
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
        echo '<p><strong>Picture:</strong></p>';
            echo '<div class=imagebox>';
            echo '<img src="data:image/jpg;charset=utf8;base64,' . base64_encode($row['B_pic']) . '" style="width: 600px; height: 400px;" />';
            echo '</div>';
        echo '</div>';
    }

    echo '</div>';
} else {
    echo '<p class="error" border= solid black >No blogs found...</p>';
}


mysqli_close($conn);
?>
</body>
</html>



