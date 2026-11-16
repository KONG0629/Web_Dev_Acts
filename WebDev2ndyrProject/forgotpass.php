<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style/forgotpass.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body>


    <div class="container">




    <?php include 'headerall.php'; ?>




            



    <!-- Content 1 -->
    
<form action="zbackend/forgotback.php" method="POST">

    <div class="content" id="content1">
        <div class="rightstyle">
            <img src="image/content.png" alt="Image 1">
        </div>
        <div class="leftstyle">
            <div class="text1">
                <h1><a href="login.php" id="backToContent1Link"><span><<</span></a>Reset your password</h1>
                <p>Enter your email address and we'll send you a link to reset your password</p>
            </div>

            <div class="label">
                <div class="center">
                    <label>EMAIL:</label><br>
                    <input type="email" name="email" required><br>
                    <a href="support.php">Need help? contact us</a>
                </div>
                <div class="btn">
                    <button type="submit" id="resetButton">Reset password</button>
                </div>

            </div>
        </div>
    </div>

</form>









<?php include 'footer.php'; ?>




</div>


</body>
</html>