<?php
session_start();
include 'db.php';  // Include the database connection

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Handle change password
if (isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $stmt = $conn->prepare("SELECT password FROM userstbl WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (password_verify($current_password, $user['password'])) {
        if ($new_password === $confirm_password) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            $update_stmt = $conn->prepare("UPDATE userstbl SET password = ? WHERE id = ?");
            $update_stmt->bind_param("si", $hashed_password, $user_id);
            $update_stmt->execute();

            echo "<script> alert('Password changed successfully!'); </script>";
        } else {
            echo "<script> alert('New password and confirm password do not match!'); </script>";
        }
    } else {
        echo "<script> alert('Current password is incorrect!'); </script>";
    }
}

// Handle delete account
if (isset($_POST['delete_account'])) {
    $delete_posts_stmt = $conn->prepare("DELETE FROM poststbl WHERE user_id = ?");
    $delete_posts_stmt->bind_param("i", $user_id);
    $delete_posts_stmt->execute();

    $delete_comments_stmt = $conn->prepare("DELETE FROM comments_tbl WHERE user_id = ?");
    $delete_comments_stmt->bind_param("i", $user_id);
    $delete_comments_stmt->execute();

    $delete_posts_stmt = $conn->prepare("DELETE FROM draftstbl WHERE user_id = ?");
    $delete_posts_stmt->bind_param("i", $user_id);
    $delete_posts_stmt->execute();

    $delete_posts_stmt = $conn->prepare("DELETE FROM poststbl WHERE user_id = ?");
    $delete_posts_stmt->bind_param("i", $user_id);
    $delete_posts_stmt->execute();

    $delete_posts_stmt = $conn->prepare("DELETE FROM post_likes_tbl WHERE user_id = ?");
    $delete_posts_stmt->bind_param("i", $user_id);
    $delete_posts_stmt->execute();
    
    $delete_posts_stmt = $conn->prepare("DELETE FROM poststbl WHERE user_id = ?");
    $delete_posts_stmt->bind_param("i", $user_id);
    $delete_posts_stmt->execute();

    $delete_posts_stmt = $conn->prepare("DELETE FROM poststbl WHERE user_id = ?");
    $delete_posts_stmt->bind_param("i", $user_id);
    $delete_posts_stmt->execute();

    $delete_user_stmt = $conn->prepare("DELETE FROM userstbl WHERE id = ?");
    $delete_user_stmt->bind_param("i", $user_id);
    $delete_user_stmt->execute();

    session_destroy();

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Settings</title>
    <link rel="stylesheet" href="style/change-password.css">
    <link rel="stylesheet" href="style/userAccounts.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">



    <?php include 'headerall.php'; ?>






        <div class="settingsContainer">
            <h1>Settings</h1>
            <div class="settingsWarning">
                <h1 class="redExclamationPoint">!</h1>
                <p>• Changes you make here are visible to your page</p>
            </div>
            <hr>
            <div>
                <a href="userProfile.php"><button type="button" class="graySettingsButton">Account</button></a>
                <a href="management.php"><button type="button" class="graySettingsButton">Notification</button></a>
                <a href="userAccount.php"><button type="button" class="graySettingsButton">Security</button></a>
            </div>
            <hr>
            <div class="settingsDetails">
                <div class="settingsSubContainers">
                    <div >
                        <h3>Password</h3>
                        <p><?php echo htmlspecialchars(str_repeat('*', 10)); ?></p>
                    </div>
                    <button type="button" id="change-password-on" class="editSettingsButton">Change password</button>
                </div>
                <hr>
                <div class="settingsSubContainers">
                    <div>
                        <h3>Account Removal</h3>
                        <br>
                    </div>
                    <div>
                    <form method="POST">
                        <button type="submit" name="delete_account" class="deleteAccountButton">Delete account</button>
                    </form>
                    </div>
                </div>
                <hr>
            </div>
        </div>




        
        <?php include 'footer.php'; ?>






    </div>

    
    <div id="display"></div>

    
    <script>
        function openNav() {
            document.getElementById("sidebar").style.width = "200px";
        }

        function closeNav() {
            document.getElementById("sidebar").style.width = "0";
        }

        function refreshPage() {
            location.reload();
        }

        document.getElementById("change-password-on").addEventListener("click", function () {
            fetch("change-password.php")
                .then(response => response.text())
                .then(data => {
                    document.getElementById("display").innerHTML = data;

                    // After the content is loaded, attach the close overlay functionality
                    const overlay = document.getElementById("overlay");
                    const exitButton = document.getElementById("exit-button");

                    // Add event listener to close the overlay when the exit button is clicked
                    exitButton.addEventListener("click", function() {
                        overlay.style.display = "none";  // Hide the overlay
                    });
                })
                .catch(error => alert("Error loading content:", error));
        });
    </script>
    
</body>
</html>