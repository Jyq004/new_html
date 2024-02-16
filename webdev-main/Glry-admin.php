<?php
include 'dbcon.php';
include 'Glry-upload.php';

if (isset($_POST['view_photos'])) {
    header('Location: gallery.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0d6539403e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/glry-admin.css">
    <title>Image Upload</title>
</head>
<body>
    <div class='container'>
        <h1>Upload Image</h1>
        <div class='wrapper'>
        <div class="return"><a href="gallery.php"><i class="fa-solid fa-arrow-left"></i></a></div>    
            <?php if(!empty($statusMsg)){ ?>
                <p class="status <?php echo $status; ?>"><?php echo $statusMsg; ?></p>
            <?php } ?>

            <form action="" method="post" enctype="multipart/form-data">
                <div class='form-group'>
                    <label for="image">Select image file</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                </div>
                <input type="submit" name="submit" class="btn-primary" value="Upload">
            </form>
        </div>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>