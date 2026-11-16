<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legal Agreement</title>
    <link rel="stylesheet" href="style/agreements.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container">




    <?php include 'headerall.php'; ?>





<!--CONTENT1-->
<div class="content">

    <div class="inside">
        <div class="text">
            <h1>Keeping You Safe and Informed</h1>
            <p>
            By using this site, you acknowledge that you have reviewed and accepted our Terms of Service and 
            Privacy Policy, designed to protect your rights and ensure a safe browsing experience.
            </p>
        </div>

    </div>

</div>
<!--CONTENT1-->




<!--CONTENT2-->

<div class="content2">

    <div class="left">
        <img src="image/privacypolicy.png">
        <div class="left2">
        <p>Learn how we protect your personal information and respect 
            your privacy by reviewing our Privacy Policy
        </p>
        <a href="privacy.php"><button type="button">Read Privacy Policy</button></a>
        </div>
    </div>

    <div class="right">
        <img src="image/terms&condi.png">
        <div class="right2">
        <p>Understand the guidelines and rules for using our 
            services by exploring our Terms and Conditions
        </p>
        <a href="terms.php"><button type="button">Read Terms and Conditions</button></a>
        </div>
    </div>

</div>


<!--CONTENT2-->






<?php include 'footer.php'; ?>



</div>

    <script src="script/sidebar.js"></script>
    
</body>
</html>