<?php
// Include database connection
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_GET['token'];
    $newPassword = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword !== $confirmPassword) {
        echo "Passwords do not match.";
        exit;
    }

    // Hash the password
    $passwordHash = password_hash($newPassword, PASSWORD_BCRYPT);

    // Hash the token and verify it
    $tokenHash = hash("sha256", $token);

    // Check if the token exists and is not expired
    $sql = "SELECT id FROM userstbl WHERE reset_token_hash = ? AND reset_token_expires_at > NOW()";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $tokenHash);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userId = $user['id'];

        // Update the password and clear the token
        $sql = "UPDATE userstbl SET password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE id = ?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("si", $passwordHash, $userId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "Password has been successfully reset. You can now <a href='login.php'>log in</a>.";
        } else {
            echo "Failed to update the password. Please try again.";
        }
    } else {
        echo "Invalid or expired reset token.";
    }
}
?>
