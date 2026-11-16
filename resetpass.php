<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="style/resetpass.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body>


<?php include 'headerall.php'; ?>


            



    <!-- Content 1 -->
<div class="content">
    <div class="rightstyle">
        <img src="image/content.png" alt="Image 1">
    </div>
    <div class="leftstyle">
        <div class="text1">
            <h1><a href="login.php"><span><<</span></a>Reset your password</h1>
        </div>

<form action="" method="POST">
    <div class="label">
        <div class="center">
            <input type="hidden" name="token" value="<?php echo $_GET['token'] ?? ''; ?>">
            <label>NEW PASSWORD:</label>
            <input type="password" name="password" required><br>
            <label>CONFIRM PASSWORD:</label>
            <input type="password" name="confirm_password" required><br>

        </div>
            <div class="btn">
                <button type="submit" id="resetButton">Reset password</button>
                <a href="support.php">Need help? contact us</a>
            </div>
        </div>
</form>

    </div>
</div>






<?php include 'footer.php'; ?>




</div>



</body>
</html>