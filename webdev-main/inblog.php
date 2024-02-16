<?php
include 'navbar.php';

if (isset($_SESSION['id'])) {
    $mID = $_SESSION['id'];
    $_SESSION['id'] = $mID;

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="blogcss.css">
        <style>
    
        </style>
    </head>
    <body>
        <h2 class="ptt">Post Blog Page</h2>
        <p></p>
        <div id="inform">
        <form action="bup.php" method="post" enctype="multipart/form-data">
            Title: <input type='text' name='title'><br>
            <p id="ct">Content:</p><br>
            <textarea id="ctbox" name='content'></textarea><br>
            <label>Select Image File:</label>
            <input type="file" name="image">
            <br><br>
            <input type="submit" name="submit" value="Upload">
        </form>
        </div>
    </body>
    </html>
   <?php 
}else {
    echo '<script>
    alert("Please login as a member to post.");
    window.location.replace("login.php");
    </script>';

    exit();
}

?>




