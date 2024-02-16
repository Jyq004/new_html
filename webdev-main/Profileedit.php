
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

        if(isset($_POST["btnupdate"])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $phnum = $_POST['phnum'];
            $statusMsg = ''; 

            if (!empty($_FILES["image"]["name"])) {
                $fileName = basename($_FILES["image"]["name"]);
                $fileSize = $_FILES["image"]["size"];
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

                if ($fileSize > 1048576) {
                    $statusMsg = "Sorry, the uploaded image size exceeds 1 MB. Please choose an image under 1 MB in size.";
                } else {
                    if (in_array($fileType, $allowTypes)) {
                        $image = $_FILES['image']['tmp_name'];
                        $propic = addslashes(file_get_contents($image));
                        $query = "UPDATE member SET ProfilePic = '$propic', Name = '$name', Email = '$email', Phone_num = '$phnum' WHERE MemberID = '$userID'";
                    } else {
                        $query = "UPDATE member SET Name = '$name', Email = '$email', Phone_num = '$phnum' WHERE MemberID = '$userID'";
                    }
                }
            } else {
                $query = "UPDATE member SET Name = '$name', Email = '$email', Phone_num = '$phnum' WHERE MemberID = '$userID'";
            }
    
            if (empty($statusMsg)) {
                $result = mysqli_query($conn, $query);

                if ($result) {
                    $_SESSION['statusMsg'] = 'Profile updated successfully.';
                    header('Location: profile.php');
                } else {
                    $_SESSION['statusMsg'] = 'Failed to update profile. Please try again.';
                }
            } else {
                $_SESSION['statusMsg'] = $statusMsg; 
            }

            header('Location: Profileedit.php');
            exit();
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0d6539403e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/profileedit.css">
    <title>Edit Profile</title>
</head>
<body>
    <?php
    if(isset($_SESSION['statusMsg'])) {
        echo '<p id="statusmsg">' . $_SESSION['statusMsg'] . '</p>';
        unset($_SESSION['statusMsg']);
    }
    ?>
    <div class="wrapper">
        <a href="profile.php"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="form">
            <h2>Edit Profile</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="name">Name:<input type="text" name="name" id="name" value="<?php echo $row['Name']; ?>"></div>
                <div class="email">Email:<input type="email" name="email" id="email" pattern="[a-zA-Z0-9._%+\-]+@(gmail|hotmail)\.com" title="Please use the format XXX@(gmail/hotmail).com." value="<?php echo $row['Email']; ?>"></div>
                <div class="phnum">Phone Number:<input type="tel" name="phnum" id="phnum" required pattern="^\+60\d{8}$" title="Please use the format +60xxxxxxxx."value="<?php echo $row['Phone_num']; ?>"></div>
                <div class="propic">Profile Picture:<input type="file" name="image"><br></div>  
                <button class="update" type="submit" name="btnupdate">Update</button>
            </form>
        </div>
        
    </div>
</body>
</html>
<?php
    } else {
        echo 'No record found.';
    }
} else {
    header("Location: login.php");
    exit();
}
?>
