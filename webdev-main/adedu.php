<?php
include 'adnavbar.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="edustyle.css">
</head>
<body>
<div class="bigwrap">
    <div class="wrapper">
        <h2>Education Page</h2>
    </div>
    <div class="wrapper2">
        <h2>
            Types of Animal
        </h2>
    </div>
    <div class="wrapper3">
        <h2>
            <button onclick="window.location.href='#hypet1'" class="btnstyle">Dogs</button>
            <button onclick="window.location.href='#hypet2'" class="btnstyle">Cats</button>
            <button onclick="window.location.href='#hypet3'" class="btnstyle">Rabbits</button>


        </h2>
    </div>
    <br>
    <div class="wrapper4" id="hypet1">
        <h2 id="t1">Dogs</h2>
        <img src="data:image/jpeg;base64,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" id="t1pic" alt="">
        <div class="ttcont">  
                <h2 class="firsttitle">Introduction to Dog Care</h2>
                <ul>
                    <li>Understanding the unique needs and behaviors of dogs is crucial for providing optimal care. This section delves into the basics of dog care, emphasizing the importance of education for dog owners.</li>
                    <li>Building a strong bond with your dog involves creating a loving and stimulating environment. Learn how to establish trust and foster a positive relationship with your canine companion through proper care and attention.</li>
                </ul>

                <h2>Choosing the Right Dog Breed</h2>
                <ul>
                    <li>Considerations for selecting a dog breed go beyond size and appearance. This section guides prospective dog owners through factors such as energy levels, exercise needs, and temperament to help them choose a breed that suits their lifestyle.</li>
                    <li>Researching the specific needs and characteristics of different dog breeds is essential for responsible ownership. Explore the diverse world of dogs and find the perfect match for your home and family.</li>
                </ul>

                <h2>Creating a Dog-Friendly Environment</h2>
                <ul>
                    <li>Providing a dog-friendly living space involves more than just food and shelter. Discover the key elements of a dog-friendly environment, including safe play areas, comfortable resting spaces, and engaging toys to keep your dog physically and mentally stimulated.</li>
                    <li>Essential dog-proofing measures for the home include identifying potential hazards and creating a secure space for your dog. Learn how to adapt your living space to meet the natural instincts and behaviors of dogs.</li>
                </ul>
        
        </div>
    </div>
    <br>
    <div class="wrapper5" id="hypet2">
        <h2 id="t2">Cats</h2>
        <img src="https://img.etimg.com/photo/98637594/98637594.jpg" id="t2pic" alt="">
        <div class="ttcont">  
            <h2 class="firsttitle">Introduction to Cat Rearing</h2>
            <ul>
                <li>Understanding the fundamentals of cat behavior and psychology is crucial for responsible cat ownership. This section explores the importance of educating cat owners about the unique needs and characteristics of feline companions.</li>
                <li>Building a strong bond with your feline friend involves creating a nurturing environment and establishing trust. Discover effective ways to connect with your cat emotionally and foster a positive relationship from the start.</li>
            </ul>

            <h2>Choosing the Right Cat Breed</h2>
            <ul>
                <li>Considerations for lifestyle and living space go beyond personal preferences. This section guides prospective cat owners through the process of selecting a cat breed that aligns with their daily routines and the available space in their homes.</li>
                <li>Researching the temperament and energy levels of different cat breeds is essential for harmonious living. Learn how to match your lifestyle with a cat that fits well, ensuring a happy and fulfilling companionship.</li>
            </ul>

            <h2>Creating a Cat-Friendly Environment</h2>
            <ul>
                <li>Providing a safe and stimulating space involves more than setting up a litter box and providing food. Explore the elements of a cat-friendly environment, from safe hiding spots to engaging toys, to ensure your cat feels secure and entertained.</li>
                <li>Essential cat-proofing measures for the home include identifying potential hazards and creating designated spaces for your cat. Learn how to make your living space conducive to a cat's natural instincts and behaviors.</li>
            </ul>
        
        </div>
    </div>
    <br>
    <div class="wrapper6" id="hypet3">
        <h2 id="t3">Rabbits</h2>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAulFDnRclMsGjN54FU5x1Gv1Jn39brbRh3g&usqp=CAU" id="t3pic" alt="">
        <div class="ttcont">  
            <h2 class="firsttitle">Introduction to Rabbit Care</h2>
            <ul>
                <li>Understanding the unique needs and behaviors of rabbits is crucial for providing optimal care. This section delves into the basics of rabbit care, highlighting the importance of education for rabbit owners.</li>
                <li>Building a strong bond with your rabbit involves creating a safe and enriching environment. Learn how to establish trust and nurture a positive relationship with your furry companion.</li>
            </ul>
        
            <h2>Choosing the Right Rabbit Breed</h2>
            <ul>
                <li>Considerations for selecting a rabbit breed go beyond appearance. This section guides potential rabbit owners through factors such as size, temperament, and grooming requirements to help them choose a breed that aligns with their preferences and lifestyle.</li>
                <li>Researching the specific needs and characteristics of different rabbit breeds is essential for providing appropriate care. Explore the diverse world of rabbits and find the perfect match for your home and family.</li>
            </ul>
        
            <h2>Creating a Rabbit-Friendly Environment</h2>
            <ul>
                <li>Providing a rabbit-friendly living space involves more than a hutch and food. Discover the key elements of a rabbit-friendly environment, including safe play areas, comfortable resting spaces, and appropriate chew toys to keep your rabbit healthy and happy.</li>
                <li>Essential rabbit-proofing measures for the home include identifying potential hazards and creating a secure space for your rabbit to explore. Learn how to adapt your living space to meet the natural instincts and behaviors of rabbits.</li>
            </ul>
        
        </div>
    </div>
    <br>
</div>



</body>
</html>