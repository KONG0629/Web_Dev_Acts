<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email and password
    if (empty($email) || empty($password)) {
        die("Email and password are required.");
    }

    // Check if the user is admin
    if ($email === "admin123@gmail.com" && $password === "admin123") {
        // If admin, redirect to the dashboard page in the admin folder
        $_SESSION['user_id'] = 'admin';
        $_SESSION['email'] = $email;
        header("Location: ../zbackend/admin/dashboard.php");
        exit();
    }

    // Query to store the password using hashed
    $stmt = $conn->prepare("SELECT id, password FROM userstbl WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);

    if ($stmt->fetch()) {
        // Verify the password entered by the user
        if (password_verify($password, $hashed_password)) {
            // Set session variables after successful login
            $_SESSION['user_id'] = $user_id;
            $_SESSION['email'] = $email;

            $stmt->close();

            // Check if the user already has a profile in the profiletbl
            $profile_check_stmt = $conn->prepare("SELECT id FROM profiletbl WHERE user_id = ?");
            $profile_check_stmt->bind_param("i", $user_id);
            $profile_check_stmt->execute();
            $profile_check_stmt->store_result();

            // Redirect based on whether the user already has a profile
            if ($profile_check_stmt->num_rows > 0) {
                // If the user already has a profile, redirect to index.php
                header("Location: ../index.php");
            } else {
                // If the user doesn't have a profile, redirect to editProfile.php
                header("Location: ../editProfile.php");
            }
            exit();
        } else {
            // If password verification fails, show error
            $_SESSION['error'] = "Invalid email or password.";
        }
    } else {
        // If no user found with the provided email, show error
        $_SESSION['error'] = "Invalid email or password.";
    }
}

// Redirect to login page if login fails
header("Location: ../login.php");
exit();
