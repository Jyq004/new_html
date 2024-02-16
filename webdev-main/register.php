<?php
include 'dbcon.php';
include 'Register-data.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0d6539403e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/register.css">
    <title>Document</title>
</head>
<body>
    <div class ='wrapper'>
        <div class='home'><a href="index.php"><i class="fa-solid fa-x"></i></a></div>
        <h2>Register</h2>
        <form action="" method='post' enctype="multipart/form-data">
        <div class='input-wrapper'>
            <div class = 'info-wrapper-left'>
                <div class="info-register"><input type="text" name="name" required placeholder="Name"></div> 
                <div class="info-register"><input type="email" name="email" pattern="[a-zA-Z0-9._%+\-]+@(gmail|hotmail)\.com" title="Please use the format XXX@(gmail/hotmail).com." required placeholder="Email"></div>  
                <div class="info-register"><input type="password" name="pass" required  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password"></div> 
                <div class="info-register"><input type="tel" name="phnum" required pattern="^\+60\d{8}$" title="Please use the format +60xxxxxxxx."placeholder="Phone Number"></div> 
            </div>
            <div class='sec-wrapper-right'>
                <div class="info-register"><input type="text" name="ff" required placeholder="Your favourite food"></div> 
                <div class="info-register"><input type="text" name="fd" required placeholder="Your favourite drink"></div>  
                <div class="info-register"><input type="text" name="ft" required placeholder="Your favourite Teacher"></div>  
                <div class="profile-pic-register"><input type="file" name="image" accept="image/*"></div>
            </div>

            <input type="submit" id="register" value="Register" name="btnregister" required> 
            <div class='register-link-login'>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
        </form>
    </div>
</body>
</html>