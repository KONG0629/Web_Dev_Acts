<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style/headeralls.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>


<!--Navigation-->
<div class="header_nav">
    <div class="logo">
        <a href="index.php"><img src="image/MLogo.png"></a>
    </div>

    
    <div class="nav">
        <a href="index.php">Home</a>
        <a href="about.php">About</a>
        <a href="support.php">Support</a>
        <a href="faq.php">FAQ</a>
        <a href="company.php">Company</a>

<div class="button">
    <a href="discovery.php"><button type="button" class="discovery">Discovery</button></a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- If logged in, show the Profile button -->
        <a href="userProfile.php"><button type="button" class="create">Profile</button></a>
    <?php else: ?>
        <!-- If not logged in, show the Create now button -->
        <a href="login.php"><button type="button" class="create">Create now</button></a>
    <?php endif; ?>
</div>

    </div>
    <span class="menu-icon" onclick="openNav()">&#9776;</span>
</div>



<div class="nav_sidebar" id="sidebar">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="index.php">Home</a>
    <a href="about.php">About</a>
    <a href="support.php">Support</a>
    <a href="faq.php">FAQ</a>
    <a href="company.php">Company</a>

<div class="buttonside">
    <a href="discovery.php"><button type="button" class="discoveryside">Discovery</button></a>
    <?php if (isset($_SESSION['user_id'])): ?>
        <!-- If logged in, show the Profile button -->
        <a href="userProfile.php"><button type="button" class="createside">Profile</button></a>
    <?php else: ?>
        <!-- If not logged in, show the Create now button -->
        <a href="login.php"><button type="button" class="createside">Create now</button></a>
    <?php endif; ?>
</div>

</div>
<!--This is for sidebar-->


<script src="script/sidebar.js"></script>

    
</body>
</html>