<?php
session_start();
include 'zbackend/db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete the user account
    $stmt = $conn->prepare("DELETE FROM profiletbl WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Log the user out after deletion
        session_destroy();
        header("Location: login.php");
        exit();
    } else {
        echo "Error deleting account.";
    }
}
?>
