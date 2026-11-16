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
        $target_dir = "../uploads/";

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
        header("Location: ../index.php");
        exit();
    } else {
        $_SESSION['error'] = "Error updating profile. Please try again later.";
        header("Location: ../editProfile.php");
        exit();
    }
}
?>
