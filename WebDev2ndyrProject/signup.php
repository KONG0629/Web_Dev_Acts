<?php

session_start();

$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success = isset($_SESSION['success']) ? $_SESSION['success'] : '';
unset($_SESSION['error'], $_SESSION['success']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="style/signups.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container">




    <?php include 'headerall.php'; ?>






        <div class="contentSignup">
        <div class="leftsign">
            <img src="image/logobox.jpg" alt="Logo Box">
            <img src="image/pexel1.jpg" alt="Pexel Image 1">
            <img src="image/pexel3.jpg" alt="Pexel Image 3">
            <img src="image/logobox.jpg" alt="Logo Box">
        </div>

            <div class="rightsign">
                <img src="image/mlogo.png">
                <h1>Sign up for an account</h1>
                <p>and start your story</p>

                <div class="icon">
                    <i class="fa-regular fa-message"></i>
                    <i class="fa-solid fa-face-smile"></i>
                    <i class="fa-solid fa-pen"></i>
                </div>

                <form action="zbackend/signback.php" method="POST">
                    <div class="label">
                        <div class="center">
                            <label>EMAIL:</label><br>
                            <input type="email" name="email" required><br>
                            <label>PASSWORD:</label><br>
                            <input type="password" name="password" required><br>
                            <label>CONFIRM PASSWORD:</label><br>
                            <input type="password" name="confirm_password" required><br>
                        </div>
                        <button type="submit">Continue</button>
                    </div>

                    <!-- Display error message if any -->
                    <?php if (!empty($error)): ?>
                        <p style="color: red; margin-top: 10px; text-align: center;"><?php echo htmlspecialchars($error); ?></p>
                    <?php endif; ?>

                    <!-- Display success message if any -->
                    <?php if (!empty($success)): ?>
                        <p style="color: green; margin-top: 10px; text-align: center;"><?php echo $success; ?></p>
                    <?php endif; ?>
                </form>

                <span>Already have an account? <a href="login.php">Sign in.</a></span>
                <p>By registering, you agree to Cadence's Terms of Service and Privacy Policy</p>
            </div>
        </div>





        <?php include 'footer.php'; ?>


        

    </div>

    <script src="script/sidebar.js"></script>
</body>
</html>
