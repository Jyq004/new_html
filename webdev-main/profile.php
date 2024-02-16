<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0d6539403e.js" crossorigin="anonymous"></script>
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <div class="container">
        <div class='home'><i id="back-btn" class="fa-solid fa-x"></i></div>
        <?php
        session_start();
        include 'dbcon.php';

        if(isset($_POST['btnlogout'])){
            unset($_SESSION['loggedin']);
            header('Location: index.php');
            exit();
        }

        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
            $userID = $_SESSION['userID'];
            $query = "SELECT * FROM member WHERE MemberID = '$userID'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                ?>
                <h2>Profile</h2>
                <div class="profile-section">
                    <div class="profile-picture">
                        <?php if($row['ProfilePic']) { ?>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['ProfilePic']); ?>" alt="Profile Picture">
                        <?php } else { ?>
                            <img src="image/profile.png">
                        <?php } ?>
                        <div class="edit-button">
                            <button><a href="Profileedit.php"><i class="fa-solid fa-pen-to-square"></i></a></button>
                        </div>
                    </div>
                    <div class="profile-info">
                        <div class="info-left">
                            <div class="info-var">Name:</div>
                            <div class="info-var">Email:</div>
                            <div class="info-var">Contact Number:</div>
                        </div>
                        <div class="info-right">
                            <div class="info"><?php echo $row['Name']; ?></div>
                            <div class="info"><?php echo $row['Email']; ?></div>
                            <div class="info"><?php echo $row['Phone_num']; ?></div>
                        </div>
                    </div>
                </div>
                <div class="logout">
                    <form action="" method="post"><input type="submit" value="Logout" name="btnlogout" class="logout-text"></form>
                </div>
            <?php } 
        } else {
            header("Location: login.php");
            exit();
        }
        ?>
    </div>


    <script>
        document.getElementById('back-btn').addEventListener('click', function() {
            <?php
            if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
                $userID = $_SESSION['userID'];
                $query = "SELECT Role FROM member WHERE MemberID = '$userID'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    if ($row['Role'] === 'Admin') {
                        echo "window.location.href = 'adindex.php';";
                    } else {
                        echo "window.location.href = 'index.php';";
                    }
                }
            }
            ?>
        });
    </script>
</body>
</html>
