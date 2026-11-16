<?php

include 'db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validation checks
    if (empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: ../signup.php");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header("Location: ../signup.php");
        exit();
    } elseif ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match.";
        header("Location: ../signup.php");
        exit();
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT id FROM userstbl WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Email is already registered.";
        header("Location: ../signup.php");
        exit();
    }

    // Hash the password and insert into the database
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO userstbl (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashed_password);

    if ($stmt->execute()) {
        // Set success message in session
        $_SESSION['success'] = "Signup successful! Please <a href='/system/php/login.php'>login here</a>.";
        header("Location: ../signup.php"); // Redirect back to signup page to display success message
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
        header("Location: ../signup.php");
        exit();
    }
}
