
<?php
include 'dbcon.php'; // Include file for database connection
include 'adnavbar.php';
// Fetch all images from the database
$query = "SELECT * FROM gallery";
$result = mysqli_query($conn, $query);

// Array to store image data
$images = [];

// Fetch image data and store in the array
while ($row = mysqli_fetch_assoc($result)) {
    $images[] = $row['Image'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/0d6539403e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/gallery.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Protest+Revolution&display=swap" rel="stylesheet">
    <title>Gallery</title>
</head>
<body>
    <h2>Gallery</h2>
    <div class="container">
        <div class="buttons">
            <button id="prev-btn"><i class="fa-solid fa-chevron-left"></i></button>
            <button id='upload'><a href="Glry-admin.php"><p>Upload</p></a></button>
            <button id="next-btn"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
        </script>
        <div class="image-container">
            <?php foreach ($images as $imageData): ?>
                <img src="data:image/jpeg;base64,<?php echo base64_encode($imageData); ?>" alt="Uploaded Image">
            <?php endforeach; ?>
        </div>
        <script>
        <?php
        if (isset($_SESSION['loggedin']) && isset($_SESSION['userRole'])) {
            $userRole = $_SESSION['userRole'];
            if ($userRole === 'Admin') {
                echo 'document.getElementById("upload").style.display = "block";';
            } else {
                echo 'document.getElementById("upload").style.display = "none";';
            }
        } else {
            echo 'document.getElementById("upload").style.display = "none";';
        }
        ?>
        </script>
    </div>
    <script src="gallery.js"></script>
</body>
</html>

<?php
mysqli_close($conn); // Close the database connection
?>