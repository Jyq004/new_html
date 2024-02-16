<?php
include 'dbcon.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="forgotpassword.css">
    <title>Document</title>
</head>
<body>
    <div class ='wrapper'>
        <form action="" method='post'>
        <div class='input-wrapper'>
            <h3>Security Question</h3>
            <input type="text" name="ff" required placeholder="Your favourite food"> <br>
            <input type="text" name="fd" required placeholder="Your favourite drink"> <br>
            <input type="text" name="ft" required placeholder="Your favourite Teacher"> <br>
        </div>
        <input type=submit value='Forgot' name='btnsubmit' required>
        </form>
        <?php
        if(isset($_POST['btnsubmit'])){
            $ff=$_POST['ff'];
            $fd=$_POST['fd'];
            $ft=$_POST['ft'];
            $query = "SELECT * FROM member WHERE Sec_ques1 = '$ff' AND Sec_ques2 = '$fd' AND Sec_ques3 = '$ft'";
            $result=mysqli_query($conn, $query);
            if(mysqli_num_rows($result) > 0){
                echo 'Record found:<br>';
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "Email: " . $row['Email'] . "<br/>";
                        echo "Password: " . $row['Password'] . "<br/>";
                    }
            } else {
                echo 'Record not found:';
            }
        }
        ?> 
        
    </div>
</body>
</html>