<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0d6539403e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <title>FurEver Guardians</title>
</head>
<body>
    <div id="banner">
        <div id="logo">
            <a href="index.php"><img src="image/logo.png" alt="FurEver Guardians"></a>
        </div>
        <div id="logo-name"><h1>FurEver Guardians</h1></div>
        <div id='search-box'>
            <div id='row-search'>
                <input type="text" id='input-box' placeholder='Search'>
                <button id='magnify' onclick='search()'><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <script src='searchlist.js'></script> 
        </div>
        <div id="profile">
            <div id="icon">                
                <?php
                session_start();
                include 'dbcon.php';
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                    $userID = $_SESSION['id'];
                    $query = "SELECT ProfilePic FROM member WHERE MemberID = '$userID'";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        if (!empty($row['ProfilePic'])) {
                            echo '<a href="profile.php"><img src="data:image/jpeg;base64,' . base64_encode($row['ProfilePic']) . '"></a>';
                        } else {
                            echo '<a href="profile.php"><img src="image/profile.png"></a>'; 
                        }
                    }
                }
                ?>
            </div>
            <div id="login"><a href="login.php">Login</a></div>
        </div>
        <script>
        <?php
        include 'dbcon.php';
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            echo 'document.getElementById("icon").style.display = "block";';
            echo 'document.getElementById("login").style.display = "none";';
        } else {
            echo 'document.getElementById("icon").style.display = "none";';
            echo 'document.getElementById("login").style.display = "block";';
        }
        ?>
        </script>
    </div>
    <div id="nav">
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="#">Pet SAAP</a>
                <ul>
                    <li><a href="#">Surrender</a></li>
                    <li><a href="#">Adoption</a></li>
                    <li><a href="#">Report</a></li>
                </ul>
            </li>
            <li>
                <a href="event.php">Event</a>
            </li>
            <li>
                <a href="#">Donation</a>
            </li>
            <li>
                <a href="volunteer.php">Volunteer</a>
            </li>
            <li>
                <a href="#">More</a>
                <ul>
                    <li><a href="#">Shop</a></li>
                    <li><a href="gallery.php">Gallery</a></li>
                    <li><a href="#">News Letter</a></li>
                    <li><a href="viewblog.php">Blog</a></li>
                    <li><a href="edupage.php">Education</a></li>
                    <li><a href="faq.html">FAQ</a></li>
                </ul>
            </li>
        </ul>
    </div>