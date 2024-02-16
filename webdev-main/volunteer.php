<?php
include 'dbcon.php';
include 'navbar.php';

if (isset($_SESSION['id'])) {
    $mID = $_SESSION['id'];
    $_SESSION['id'] = $mID;
    $query = "SELECT * FROM volunteer WHERE MemberID='$mID'";
    $results = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($results) == 1) {
        $row = mysqli_fetch_assoc($results);
        $vID = $row['VolunteerID'];
        $_SESSION['vID'] = $vID;


    $queryshelCount = "SELECT COUNT(VolunteerID) as totalshelDone FROM `shel_vol` WHERE VolunteerID='$vID' and Status='Approved'";
    $resultshelCount = $conn->query($queryshelCount);
    $rowshelCount = $resultshelCount->fetch_assoc();
    $totalshelDone = $rowshelCount['totalshelDone'];
    
    // Update Total shelter helped
    $upquery = "UPDATE `volunteer` SET `ShelterNum`='$totalshelDone' WHERE VolunteerID='$vID'";
    $upresult=mysqli_query($conn,$upquery);


        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="volstyle.css">
        </head>
        <body>
        <H2 class="ptt">Volunteer</H2>
        <H2 class="ptt2">Needed</H2>
        <div class="context">
        <p class="sp">
Volunteering for animal care is a profoundly fulfilling experience. Beyond the immediate joy of assisting animals, volunteers gain valuable skills in tasks like grooming and healthcare. This hands-on experience not only benefits the animals but also enhances volunteers' personal and professional growth, opening doors to potential careers in veterinary care. The emotional rewards are equally significant, as the bond formed with animals has been shown to reduce stress and boost well-being. Additionally, volunteering fosters a sense of community among like-minded individuals, creating lasting connections and friendships. In just a few hours a week, volunteers make a positive impact on animal lives while experiencing personal enrichment.</p>
        </div>
    
        <div class="btnset">
        <form action="event.php" method='post'>
            <input type="submit" name='subbtn' value='View Event'>
        </form>
        <form action="shelter.php" method='post'>
            <input type="submit" name='shelbtn' value='Help Pet Shelter'>
        </form>
        </div>

   <div class="helpedlist">
        <?php
    $selquery = " SELECT * From volunteer where VolunteerID='$vID'";
    $resultsel= mysqli_query($conn,$selquery);
    if(mysqli_num_rows($resultsel)==1){
        $rowsel= mysqli_fetch_assoc($resultsel);
        echo '<table border=1>
                    <tr>
                        <th>VolunteerID</th>
                        <th>Total Event Joined</th>
                        <th>Total Help for Shelter</th>
                    </tr>
                    <tr>
                        <td>' . $row['VolunteerID'] . '</td>
                        <td>' . $row['EventNum'] . '</td>
                        <td>' . $row['ShelterNum'] . '</td>
                    <tr>
                </table>';
    }
    ?></div>
    <?php

    } else {
    
        $_SESSION['vID'] = '';
        $_SESSION['id'] = $mID;
    
    
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="volstyle.css">
        </head>
        <body>
        <H2 class="ptt">Volunteer</H2>
        <H2 class="ptt2">Needed</H2>
        <div class="context">
        <p class="sp">
Volunteering for animal care is a profoundly fulfilling experience. Beyond the immediate joy of assisting animals, volunteers gain valuable skills in tasks like grooming and healthcare. This hands-on experience not only benefits the animals but also enhances volunteers' personal and professional growth, opening doors to potential careers in veterinary care. The emotional rewards are equally significant, as the bond formed with animals has been shown to reduce stress and boost well-being. Additionally, volunteering fosters a sense of community among like-minded individuals, creating lasting connections and friendships. In just a few hours a week, volunteers make a positive impact on animal lives while experiencing personal enrichment.</p>
        </div>
    
        <div class="btnset">
        <form action="event.php" method='post'>
            <input type="submit" name='subbtn' value='View Event'>
        </form>
        <form action="shelter.php" method='post'>
            <input type="submit" name='shelbtn' value='Help Pet Shelter'>
        </form>
        </div>
    
        <?php
    }
    
} else{

?>
    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="volstyle.css">
        </head>
        <body>
        <H2 class="ptt">Volunteer</H2>
        <H2 class="ptt2">Needed</H2>
        <div class="context">
        <p class="sp">
Volunteering for animal care is a profoundly fulfilling experience. Beyond the immediate joy of assisting animals, volunteers gain valuable skills in tasks like grooming and healthcare. This hands-on experience not only benefits the animals but also enhances volunteers' personal and professional growth, opening doors to potential careers in veterinary care. The emotional rewards are equally significant, as the bond formed with animals has been shown to reduce stress and boost well-being. Additionally, volunteering fosters a sense of community among like-minded individuals, creating lasting connections and friendships. In just a few hours a week, volunteers make a positive impact on animal lives while experiencing personal enrichment.</p>
        </div>
    
        <div class="btnset">
        <form action="event.php" method='post'>
            <input type="submit" name='subbtn' value='View Event'>
        </form>
        <form action="shelter.php" method='post'>
            <input type="submit" name='shelbtn' value='Help Pet Shelter'>
        </form>
        </div>



<?php
}
    mysqli_close($conn);
?>








