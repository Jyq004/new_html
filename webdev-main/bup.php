<?php

Include 'dbcon.php'; 
session_start();
if(isset($_SESSION['id'])){
    $mID = $_SESSION['id'];
    $_SESSION['id'] = $mID;

    $status = $statusMsg = ''; 
    $maxFileSize = 1 * 1024 * 1024; 

    if (isset($_POST["submit"])) { 
        $queryCount = "SELECT COUNT(BlogID) as totalblog FROM `blog`";
        $resultCount = $conn->query($queryCount);
        $row = $resultCount->fetch_assoc();
        $totalblog = $row['totalblog'];
        $blogID = 'B' . ($totalblog + 1);

        $tt = $_POST['title'];
        $ct = $_POST['content'];
        $status = 'error'; 

        if (!empty($_FILES["image"]["name"])) { 

            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 

            $allowTypes = array('jpg', 'png', 'jpeg', 'gif'); 
            if (in_array($fileType, $allowTypes)) { 
                $imageSize = $_FILES['image']['size'];
                
                if ($imageSize <= $maxFileSize) {
                    $image = $_FILES['image']['tmp_name']; 
                    $imgContent = addslashes(file_get_contents($image)); 
                    
                    $query = "INSERT INTO `blog`(`BlogID`, `MemberID`, `Title`, `Content`, `Date`, `Status`, `B_pic`) VALUES ('$blogID','$mID','$tt','$ct',NOW(),'Pending','$imgContent')";
                    $result = mysqli_query($conn, $query);
                    
                    if ($result) {
                        echo '<script>
                        alert("Successfully Sent, Please kindly wait for approval");
                        window.location.replace("viewblog.php");
                        </script>';
                    } else { 
                        echo '<script>
                        alert("File upload failed, please try again.");
                        window.location.replace("viewblog.php");
                        </script>';
                    }  
                } else {
                    echo '<script>
                        alert("Sorry, the uploaded image is too large. Maximum allowed size is 1 MB.");
                        window.location.replace("viewblog.php");
                        </script>';
                }
            } else { 
                    echo '<script>
                        alert("Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.");
                        window.location.replace("viewblog.php");
                        </script>';
            } 
        } else { 
                echo '<script>
                    alert("Please select an image file to upload.");
                    window.location.replace("viewblog.php");
                    </script>';
        } 
    } 
}else{
    echo '<script>
    alert("Please login before you post.");
    window.location.replace("login.php");
    </script>';
}

mysqli_close($conn);
?>
