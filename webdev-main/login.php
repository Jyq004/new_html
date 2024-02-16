<?php
session_start();
include 'dbcon.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0d6539403e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body class='page-login'>
    <div class='wrapper-login'>
        <div class='home'><a href="index.php"><i class="fa-solid fa-x"></i></a></div>
        <form action="" method="post">
            <h1>Login</h1>
            <div class='input-box-login'>
                <input type='email' name='txtemail' placeholder='Email' required>
            </div>
            <div class='input-box-login'>
            <input type='password' name='txtPassword' placeholder='Password' required>
            </div>
            <div class='forgot-login'>
                <a href="forgotPassword.php">Forgot password?</a>
            <?php            
            if (isset($_POST['btnLogin'])){
                $em=$_POST['txtemail'];
                $password=$_POST['txtPassword'];
                $query = "SELECT * FROM member WHERE Email='$em' AND Password='$password'";

                $results=mysqli_query($conn, $query);
                if(mysqli_num_rows($results) > 0){
                    $row = mysqli_fetch_assoc($results);
                    $userRole = $row['Role'];
                    $userID = $row['MemberID'];
                    $_SESSION['id'] = $userID;
                    $_SESSION['userRole'] = $userRole;
                    $_SESSION['loggedin'] = true;

                    if($userRole=='Member'){
                    header('Location: index.php');
                    } else{
                    header('Location: adindex.php');
                    }

                } else {
                    echo'Please try again';
                }
            }
            ?>
            </div>
            <button type='submit' name='btnLogin' class='btnLogin'>Login</button>
            <div class='register-link-login'>
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </div>
        </form>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>