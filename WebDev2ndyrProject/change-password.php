<?php
session_start();
include 'zbackend/db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user profile data
$profile_stmt = $conn->prepare("SELECT email, username, author_name, page_title, description, profile_icon 
                                FROM profiletbl WHERE user_id = ?");
$profile_stmt->bind_param("i", $user_id);
$profile_stmt->execute();
$profile_result = $profile_stmt->get_result();
$user = $profile_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="style/change-password.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="overlay" id="overlay">
        <div class="container">
            <button class="exit-button" id="exit-button"><i class="fa-solid fa-chevron-left"></i>Change Password</button>
            <div class="profile">
                <img src="<?= !empty($user['profile_icon']) ? htmlspecialchars($user['profile_icon']) : 'image/default-icon.jpg' ?>">
                <div class="details">
                    <p><?= htmlspecialchars($user['author_name'] ?? 'N/A') ?></p>
                    <h1><?= htmlspecialchars($user['page_title'] ?? 'N/A') ?></h1>
                </div>
            </div>
            
            <div class="settingsDetails">
                <div class="settingsSubContainers">
                    <form method="POST"><br>
                        <div class="input-wrapper">
                            <input type="password" name="current_password" placeholder=" " required>
                            <div class="styled-placeholder">
                                Current Password<span>*</span>
                            </div>
                        </div>
                        <div class="input-wrapper">
                            <input type="password" name="new_password" placeholder=" " required>
                            <div class="styled-placeholder">
                                New Password<span>*</span>
                            </div>
                        </div>
                        <div class="input-wrapper">
                            <input type="password" name="confirm_password" placeholder=" " required>
                            <div class="styled-placeholder">
                                Confirm Password<span>*</span>
                            </div>
                        </div>
                        
                        <button type="submit" name="change_password" class="editSettingsButton">Change password</button>
                    </form>
                </div><br>
                <hr>
                
                <div class="settingsSubContainers">
                    <div>
                        <h3>Account Removal</h3>
                        <p>This will permanently delete your account and all your data. Are you sure?</p>
                    </div>
                    <form method="POST">
                        <button type="submit" name="delete_account" class="deleteAccountButton">Delete account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>