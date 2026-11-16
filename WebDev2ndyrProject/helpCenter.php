<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>faqs</title>
    <link rel="stylesheet" href="style/helpCenter.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container">



    <?php include 'headerall.php'; ?>






<!--CONTENT1-->
<div class="content">

    <div class="inside">
        <h1>How can we</h1>
        <h1>assist you today?</h1>
        <p>
            Explore our comprehensive resources to find tailored solutions, helpful tips, and expert guidance. 
            We're here to make your experience smooth and efficient.
        </p>

        <!-- Call to Action Button -->
        <a href="about.php"><button type="button" class="cta-button">Learn More About Us</button></a>
        </div>

</div>
<!--CONTENT1-->





<!--CONTENT2-->

<div class="content2">

    <div class="left">
        <img src="image/faqs.png">
        <div class="left2">
        <p>Got questions about our services or policies? 
            Explore our FAQ section for quick and comprehensive answers to commonly asked queries
        </p>
        <a href="faq.php"><button type="button">Go to FAQ</button></a>
        </div>
    </div>

    <div class="right">
        <img src="image/help.png">
        <div class="right2">
        <p>Looking for assistance or troubleshooting help?
            Visit our Support Page to connect with resources and expert guidance tailored to your needs.
        </p>
        <a href="support.php"><button type="button">Go to Support page</button></a>
        </div>
    </div>

</div>


<!--CONTENT2-->







<?php include 'footer.php'; ?>





</div>

    <script src="script/sidebar.js"></script>
    
</body>
</html>