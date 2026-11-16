<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];  // Get the logged-in user's ID

// Ensure the user_id exists in userstbl
$stmt = $conn->prepare("SELECT email FROM userstbl WHERE id = ?"); // 'id' is the primary key in userstbl
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

if (!$user_data) {
    $_SESSION['error'] = "Error: User does not exist.";
    header("Location: ../editProfile.php");
    exit();
}

$email = $user_data['email'];  // Retrieve the email for use in profiletbl

// Fetch existing profile data for the form
$stmt = $conn->prepare("SELECT author_name, username, page_title, description, profile_icon FROM profiletbl WHERE user_id = ?"); // 'user_id' is the FK in profiletbl
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$profile = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch form data
    $author_name = $_POST['author_name'] ?? '';
    $username = $_POST['username'] ?? '';
    $page_title = $_POST['page_title'] ?? '';
    $description = $_POST['description'] ?? '';
    $profile_icon = null;  // Default is no icon

    // Handle file upload (Profile Icon)
    if (!empty($_FILES['profile_icon']['name'])) {
        $target_dir = "uploads/";

        // Ensure the uploads directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $profile_icon = $target_dir . time() . "_" . basename($_FILES["profile_icon"]["name"]);

        // Move uploaded file
        if (move_uploaded_file($_FILES["profile_icon"]["tmp_name"], $profile_icon)) {
            $profile_icon = $conn->real_escape_string($profile_icon);
        } else {
            echo "<p style='color: red;'>File upload failed. Please try again.</p>";
            $profile_icon = null; // Set to null if upload fails
        }
    } else {
        echo "<p style='color: red;'>No file uploaded.</p>";
    }

    // Check if the profile exists for the logged-in user
    $stmt = $conn->prepare("SELECT id, profile_icon FROM profiletbl WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $existing_profile = $result->fetch_assoc();

    if ($result->num_rows == 0) {
        // Insert a new profile if it doesn't exist
        $stmt = $conn->prepare("INSERT INTO profiletbl (user_id, email, author_name, username, page_title, description, profile_icon) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $user_id, $email, $author_name, $username, $page_title, $description, $profile_icon);
    } else {
        if ($profile_icon === null) {
            $profile_icon = $existing_profile['profile_icon'];
        }

        // Update the existing profile
        $stmt = $conn->prepare("UPDATE profiletbl SET email = ?, author_name = ?, username = ?, page_title = ?, description = ?, profile_icon = ? WHERE user_id = ?");
        $stmt->bind_param("ssssssi", $email, $author_name, $username, $page_title, $description, $profile_icon, $user_id);
    }

    if ($stmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Error updating profile. Please try again later.";
        header("Location: editProfile.php");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style/editProfs.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>


<body>


    <div class="container">




    <?php include 'headerall.php'; ?>



<!-- Content Slider -->
<div id="content-slider">
            

<form action="editProfile.php" method="POST" enctype="multipart/form-data">

    <!-- Content 1 -->
    <div class="content">
        <div class="leftstyle">
            <span>1 / 4</span>
            <h1>What do you want to be called?</h1>
            <div class="label">
                <label for="author_name">Author name:</label><br>
                <input type="text" id="author_name" name="author_name" value="<?= htmlspecialchars($profile['author_name'] ?? '') ?>"><br>
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($profile['username'] ?? '') ?>"><br>
            </div>
        </div>
        <div class="rightstyle">
            <img src="image/pexel1.jpg" alt="Image 1">
        </div>
    </div>

            <!-- Content 2 -->
            <div class="content">
                <div class="leftstyle">
                    <span>2 / 4</span>
                    <h1>What's the title of your page?</h1>
                    <div class="label">
                        <label for="page_title">Page title:</label><br>
                        <input type="text" id="page_title" name="page_title" value="<?= htmlspecialchars($profile['page_title'] ?? '') ?>"><br>
                    </div>
                </div>
                <div class="rightstyle">
                    <img src="image/pexel3.jpg" alt="Image 2">
                </div>
            </div>

                    <!-- Content 3 -->
                    <div class="content">
                        <div class="leftstyle">
                            <span>3 / 4</span>
                            <h1>Describe your page...</h1>
                            <div class="label">
                                <label for="description">About your page:</label><br>
                                <textarea id="description" name="description"><?= htmlspecialchars($profile['description'] ?? '') ?></textarea><br>
                            </div>
                        </div>
                        <div class="rightstyle">
                            <img src="image/pexel2.jpg" alt="Image 3">
                        </div>
                    </div>

                        <!-- Content 4 -->
                        <div class="content">
                            <div class="leftstyle">
                                <span>4 / 4</span>
                                <h1>Change how others see you...</h1>
                                <div class="circle">
                                    <!-- Profile Icon Preview -->
                                    <label for="profile_icon" class="profile-label">
                                        <img 
                                            id="iconPreview" 
                                            src="<?= htmlspecialchars($profile['profile_icon'] ?? "image\default-icon.jpg") ?>" 
                                            alt="Profile Icon" 
                                            style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; cursor: pointer;">
                                        <i class="fa-solid fa-pen edit-icon"></i>
                                    </label>

                                    <!-- File Input -->
                                    <input type="file" id="profile_icon" name="profile_icon" accept="image/*" style="display: none;" onchange="previewIcon(event)">
                                </div>
                                
                            </div>

                            <div class="rightstyle">
                                <img src="image/home4.jpg" alt="Image 4">
                            </div>
                        </div>


    
    </div>


        <div class="buttonSub">
            <button type="submit" class="sub">Submit</button>
        </div>

</form>

<!-- Navigation Buttons -->
<div class="nav-buttons">
    <button onclick="prevSlide()"><<</button>
    <button onclick="nextSlide()">>></button>
</div>







<?php include 'footer.php'; ?>




</div>

    <script src="script/sidebar.js"></script>
    <script src="script/sliding.js"></script>
    <script src="script/editprofile.js"></script>
    
    
</body>
</html>