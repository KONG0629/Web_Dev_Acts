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
$stmt = $conn->prepare("SELECT email, username, author_name, page_title, description, profile_icon FROM profiletbl WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Detail Settings</title>
    <link rel="stylesheet" href="style/userSetting.css">
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
                    <div>
                        <h3>Email Address</h3>
                        <p><?= htmlspecialchars($user['email'] ?? 'N/A') ?></p>
                    </div>
                </div>
                <hr>
                <div class="settingsSubContainers">
                    <div>
                        <h3>Username</h3>
                        <p><?= htmlspecialchars($user['username'] ?? 'N/A') ?></p>
                    </div>
                </div>
                <hr>
                <div class="settingsSubContainers">
                    <div>
                        <h3>Author Name<span style="color: #FF0000;">*</span></h3>
                        <p><?= htmlspecialchars($user['author_name'] ?? 'N/A') ?></p>
                    </div>
                </div>
                <hr>
                <div class="settingsSubContainers">
                    <div>
                        <h3>Page Title<span style="color: #FF0000;">*</span></h3>
                        <p><?= htmlspecialchars($user['page_title'] ?? 'N/A') ?></p>
                    </div>
                </div>
                <hr>
                <div class="settingsSubContainers">
                    <div>
                        <h3>About Section<span style="color: #FF0000;">*</span></h3>
                        <p><?= htmlspecialchars($user['description'] ?? 'N/A') ?></p>
                    </div>
                </div>
                <hr>
                <div class="settingsSubContainers">
                    <div>
                        <h3>Profile Picture<span style="color: #FF0000;">*</span></h3>
                        <img src="<?= !empty($user['profile_icon']) ? htmlspecialchars($user['profile_icon']) : 'image/default-icon.jpg' ?>" alt="Profile Icon">
                        </div>
                </div>
                <hr>

                <a href="editProfile.php?section=email"><button type="button" class="editSettingsButton">Edit</button></a>
                <button type="button" class="editSettingsButton" onclick="confirmDelete()">Delete</button>
                <a href="zbackend/logout.php"><button type="button" class="editSettingsButton">Logout</button></a>

            </div>
        </div>




        <?php include 'footer.php'; ?>




    </div>



    <script src="script/deleteAccount.js"></script>
    
    <script src="script/sidebar.js"></script>



</body>
</html>
