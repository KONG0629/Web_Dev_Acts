<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About our Company</title>
    <link rel="stylesheet" href="style/companys.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">




    <?php include 'headerall.php'; ?>





        <!-- About Contents -->
        <div class="blue-container">
            <div class="centering-container">
                <div class="logo-and-name">
                    <img src="image/logo_art.png" alt="logo_art">
                    <h1>One Byte Alliance</h1>
                </div>
            </div>
        </div>

        <div class="about-container">
            <div class="containerBackground">
                <div class="text-container">
                    <div class="marginalized-container">
                        <p>
                        Cadence Blog is more than just a blog, it's a community and a journey. We invite our readers to be a part of this journey by joining the conversation, sharing their thoughts, and connecting with others who believe in the power of stories and insights to inspire change. Our readers are an essential part of who we are, and we’re always here to listen, learn, and grow alongside them.
                        </p>
                    </div>
                    <div class="containerContent">
                        <div class="containerImage">
                            <img src="image/logo_art.png">
                        </div>
                        <div class="containerText">
                            <!--<h1>Lorem Ipsum</h1>-->
                            <p>
                            Cadence Blog was born out of a desire to create a meaningful digital destination, one that goes beyond surface-level content and taps into the heart of what makes stories truly transformative. With a team of passionate writers, editors, and creatives, we’re here to share knowledge and spark conversations that inspire readers to take action, think differently, and discover new possibilities. Every article we publish is crafted with care, research, and a commitment to delivering real value to our readers                            </p>
                        </div>
                    </div>
                    <div class="contentContainer">
                    
                        <div class="contentImages">
                    
                            <div class="imageContainer">
                                <img src="image/lagutan.png">
                                <div class="imageOverlay">
                                    <h1><b>Glenn Mar V. Lagutan</b></h1>
                                    <p>Team Leader</p>
                                </div>
                            </div>
                    
                            <div class="imageContainer">
                                <img src="image/kong.png">
                                <div class="imageOverlay">
                                    <h1><b>Jerry Kong Jr.</b></h1>
                                    <p>Full Stack Developer</p>
                                </div>
                            </div>
                    
                            <div class="imageContainer">
                                <img src="image/geesha.jpg">
                                <div class="imageOverlay">
                                    <h1><b>Geesha Marie Ico Cruz</b></h1>
                                    <p>Information Architecture</p>
                                </div>
                            </div>
                    
                            <div class="imageContainer">
                                <img src="image/kurt.png">
                                <div class="imageOverlay">
                                    <h1><b>Kurt Aaron Apostol</b></h1>
                                    <p>UI/UX Designer</p>
                                </div>
                            </div>
                    
                            <div class="imageContainer">
                                <img src="image/preli.jpg">
                                <div class="imageOverlay">
                                    <h1><b>Joseph D. Preligera IV</b></h1>
                                    <p>Full Stack Developer</p>
                                </div>
                            </div>
                    
                            <div class="imageContainer">
                                <img src="image/alexin.jpg">
                                <div class="imageOverlay">
                                    <h1><b>Alexin Kaye Parapina</b></h1>
                                    <p>Content Manager</p>
                                </div>
                            </div>
                    
                        </div>
                    
                    </div>
                <!-- <div class="learn-container">
                        <h1>Learn about the Company</h1>
                        <p>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Autem incidunt cupiditate obcaecati possimus placeat veniam. Quis reiciendis repellendus unde vel. Consequuntur minima suscipit consequatur voluptate vero exercitationem facilis necessitatibus illum?
                        </p><br>
                        <p>
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cum reiciendis, optio rerum doloremque at eaque nobis.
                        </p><br>
                        <a href="postManagement.php"><button type="button" class="learn">Read Company Information</button></a>
                    </div>-->
                </div>
            </div>
        </div>
        <!-- About Contents -->




        <?php include 'footer.php'; ?>




    </div>

    <script src="script/sidebar.js"></script>

</body>
</html>