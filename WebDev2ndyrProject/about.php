<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About us</title>
    <link rel="stylesheet" href="style/abouts.css">
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
                    <h1>by: <u>One Byte Alliance</u></h1>
                </div>
                    <h1>Making Way for Stories That Sparks, Insights That Inspire.</h1>
            </div>
        </div>

        <div class="about-container">
            <div class="containerBackground">
                <div class="text-container">
                    <div class="marginalized-container">
                        <h1>Welcome to Cadence!</h1>
                        <p>
                        We are dedicated to making way for stories that spark and insights that inspire. We believe that stories have the unique power to connect, influence, and transform lives. Our mission is to harness this power, creating meaningful content that resonates with audiences, fuels curiosity, and sparks inspiration in ways that leave a lasting impact.

                        </p>
                    </div>
                    <div class="containerContent">
                        <div class="containerImage">
                            <img src="image/logo_art.png">
                        </div>
                        <div class="containerText">
                            <h1>At Cadence blog</h1>
                            <p>
                            We have built a team of passionate creators, innovators, and strategists who share a common vision: to create experiences that go beyond just words or images. For us, each piece of content is a step towards something bigger, an idea that ignites curiosity, a perspective that broadens horizons, or a solution that empowers positive change. Whether it’s through insightful articles, engaging media, or innovative campaigns, we aim to deliver content that doesn’t just inform but moves our audience
                            </p>
                        </div>
                    </div>
            
                    <div class="containerContent">
                        <div class="containerText">
                            <h1>Our Journey</h1>
                            <p>
                            began with a simple idea: to tell stories that matter and to help our clients and readers uncover new possibilities. Since then, we’ve evolved into a multi-faceted company that provides a range of services designed to meet the needs of an ever-changing world. From thought-provoking blogs and videos to creative digital solutions, every project we take on is rooted in our commitment to quality, creativity, and purpose. We approach each story as a conversation invitation for our audience to explore, discover, and connect.
                            </p>
                            </div>
                        
                        <div class="containerImage">
                            <img src="image/logo_art.png">
                        </div>
                    </div>
            
                    <div class="containerContent">
                        <div class="containerImage">
                            <img src="image/logo_art.png">
                        </div>
                        <div class="containerText">
                            <!--<h1>Lorem Ipsum</h1>-->
                            <p>
                            Thank you for being part of our journey. Whether you’re here to find information, inspiration, or a partner for your next big idea, we’re excited to welcome you to Cadence blog. Let’s create something meaningful together with stories that spark, insights that inspire, and connections that truly matter.
                            </p>
                        </div>
                    </div>
                    <div class="learn-container">
                        <h1>Learn about the Company</h1>
                        <br><p>
                        At Cadence, we empower individuals and businesses to succeed in the digital world with innovative solutions, valuable content, and a supportive community. We’re here to inspire, educate, and guide you toward success.
                        </p><br>
                        <a href="company.php"><button type="button" class="learn">Check Here</button></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About Contents -->



<?php include 'footer.php'; ?>



    </div>

    <script src="script/sidebar.js"></script>

</body>
</html>