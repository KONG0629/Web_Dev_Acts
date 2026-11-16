<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/indexs.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>


    <div class="container">


<?php include 'headerall.php'; ?>



<!--This is for content-->
<div class="content">

    <div class="left-side">

        <div class="animate">
            <span></span>
        </div>

        <p>Create, customize, and elevate your dream website effortlessly with Cadence</p>
        <a href="userProfile.php"><button type="button" class="content-button">Create a page</button></a>
        </div>
            <div class="right-side">
                <img src="image/pexel2.jpg">
                <img src="image/pexel1.jpg">
                <img src="image/pexel3.jpg">
            </div>
</div>
<!--This is for content-->




<div class="contentContainer">
    <h1>Discover Stories Made with Cadence</h1>

    <div class="contentImages">

        <div class="imageContainer">
            <img src="image/home1.jpg">
            <!--<div class="imageOverlay">
                <p>yan na pinakamaayos</p>
            </div>-->
        </div>

        <div class="imageContainer">
            <img src="image/home3.jpg">
            <!--<div class="imageOverlay">
                <p>kong image sa gallery ko</p>
            </div>-->
        </div>

        <div class="imageContainer">
            <img src="image/home2.jpg">
            <!--<div class="imageOverlay">
                <p>kakatamad magdownload e</p>
            </div>-->
        </div>

        <div class="imageContainer">
            <img src="image/home4.jpg">
            <!--<div class="imageOverlay">
                <p>kaya ayan nalang image</p>
            </div>-->
        </div>

        <div class="imageContainer">
            <img src="image/home7.jpg">
            <!--<div class="imageOverlay">
                <p>na nilagay ko dyan</p>
            </div>-->
        </div>

        <div class="imageContainer">
            <img src="image/home6.jpg">
            <!--<div class="imageOverlay">
                <p>Asong handa nang lumaban</p>
            </div>-->
        </div>

    </div>

</div>






<div class="containerBackground">
    <div>
        <div class="containerContent">
            <div class="containerImageLeft">
                <img src="image/profile_picture.jpg">
            </div>
            <div class="containerText">
                <h1>Learn Guitar with Kita Kita</h1>
                <p>
                    I am Kita! A guitar player from the band Kessoku! 
                    I like to help others to play guitar and have fun 
                    with everyone by learning from them too when we go 
                    on a concert tour such as their cultures, language, 
                    and many more!</p>
                <a href="discovery.php"><button type="button" class="content-button">See here!</button></a>
            </div>
        </div>

        <div class="containerContentRight">
            <div class="containerText">
                <h1>Post Updates</h1>
                <p>
                Manage effortlessly — edit, organize, and track performance all in one place.
                </p>
                <a href="management.php"><button type="button" class="content-button">Manage here</button></a>
                </div>
            
            <div class="containerImageRight">
                <img src="image/updates.png">
            </div>
        </div>

        <div class="containerContent">
            <div class="containerImageLeft">
                <img src="image/cooking.jpg">
            </div>
            <div class="containerText">
                <h1>Cooking Tips</h1>
                <p>At first, cooking can be very intimidating; it’s a vital life skill anyone can learn. Whether you want to prepare healthy meals for yourself, save money by dining at home, or impress family and friends, these beginner-friendly tips from Girl and the Kitchen will set you on the path to culinary success. We believe that cooking should be approachable, fun, and, above all, delicious!</p>
                <a href="discovery.php"><button type="button" class="content-button">Read here</button></a>
            </div>
        </div>
    </div>
</div>




<?php include 'footer.php'; ?>



</div>

    <script src="script/sidebar.js"></script>

    
</body>
</html>