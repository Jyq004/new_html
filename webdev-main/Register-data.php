<?php
session_start();
include 'dbcon.php';

if (isset($_POST["btnregister"])) {
    $name = $_POST['name'];
    $em = $_POST['email'];
    $pw = $_POST['pass'];
    $phnum = $_POST['phnum'];
    $ff = $_POST['ff'];
    $fd = $_POST['fd'];
    $ft = $_POST['ft'];
    $status = 'error';
    $propic = '';
    $statusMsg = ''; 

    if (!empty($_FILES["image"]["name"])) {
        $fileName = basename($_FILES["image"]["name"]);
        $fileSize = $_FILES["image"]["size"]; 

        if ($fileSize > 1048576) {
            $statusMsg = "Sorry, the uploaded image size exceeds 1 MB. Please choose an image under 1 MB in size.";
        } else {
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
            if (in_array($fileType, $allowTypes)) {
                $image = $_FILES['image']['tmp_name'];
                $propic = addslashes(file_get_contents($image));
            } else {
                $statusMsg = "Sorry, only JPG, PNG, JPEG, and GIF files are allowed to upload.";
            }
        }
    } else {
        $defaultImage = 'profile.png';
        $propic = addslashes(file_get_contents($defaultImage));
    }

    if (empty($statusMsg)) {
        $queryCount = "SELECT COUNT(MemberID) as totalMembers FROM member";
        $resultCount = $conn->query($queryCount);

        $row = $resultCount->fetch_assoc();
        $totalMembers = $row['totalMembers'];
                    
        $newMemberID = 'M' . ($totalMembers + 1);
        $query = "INSERT INTO member (MemberID, ProfilePic, Name, Role, Email, Password, Phone_num, Sec_ques1, Sec_ques2, Sec_ques3) 
                VALUES ('$newMemberID','$propic', '$name', 'Member', '$em', '$pw', '$phnum', '$ff', '$fd', '$ft')";
        $insert = mysqli_query($conn, $query);
        
        if ($insert) {
            $status = 'success';
            $statusMsg = 'Registration successful.';
        } else {
            $statusMsg = 'Registration failed. Please try again.';
        }
    }

    if ($status === 'success') {
        echo '<script>
        alert("Registered successfully");
        window.location.replace("login.php");
        </script>';
    } else {
        echo '<script>
        alert("' . $statusMsg . '");
        window.location.replace("register.php");
        </script>';
    }
}
?>
