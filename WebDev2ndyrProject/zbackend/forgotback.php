<?php


// Include database connection
include 'db.php';

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Require PHPMailer classes
require '../phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$email = $_POST['email']; // Get email from POST request

// Check if the email exists in the database
$sql = "SELECT id FROM userstbl WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Proceed if the email exists in the database
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $userId = $user['id'];

    // Generate a unique token for password reset
    $token = bin2hex(random_bytes(16)); // Generate a 32-character token
    $tokenHash = hash("sha256", $token); // Store token as a hashed value for security
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30); // Token expires in 30 minutes

    // Store the token and expiration in the database securely
    $sql = "UPDATE userstbl SET reset_token_hash = ?, reset_token_expires_at = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $tokenHash, $expiry, $userId);
    $stmt->execute();

    // If the token is successfully stored, send the reset email using PHPMailer
    if ($stmt->affected_rows > 0) {
        // Build the reset link
        $resetLink = "http://abc123.ngrok.io/yourproject/resetpass.php?token=$token"; // Update with your domain

        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Server settings for SMTP (Gmail in this case)
            $mail->isSMTP();                                           // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                        // Set SMTP server to Gmail
            $mail->SMTPAuth   = true;                                    // Enable SMTP authentication
            $mail->Username   = 'onebytecadence@gmail.com';              // Your Gmail address
            $mail->Password   = 'ruhe qejh ixyp ruhn';                   // Your Gmail app password (generated for Gmail 2FA)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Enable TLS encryption
            $mail->Port       = 587;                                     // SMTP port (587 for TLS)

            // Recipients
            $mail->setFrom('onebytecadence@gmail.com', 'Cadence');       // Sender's email and name
            $mail->addAddress($email);                                   // Recipient's email (from form submission)

            // Content of the email
            $mail->isHTML(true);                                         // Set email format to HTML
            $mail->Subject = 'Password Reset Request';                   // Subject of the email
            $mail->Body    = "Hello,<br><br>We received a request to reset your password. Please click the link below to reset your password:<br><br><a href=\"$resetLink\">Reset Your Password</a><br><br>This link will expire in 30 minutes.";

            // Send the email
            if ($mail->send()) {
                echo "A reset link has been sent to your email.";
            } else {
                echo "Failed to send reset email. Please try again.";
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"; // Show error if mail fails to send
        }
    } else {
        echo "Failed to generate reset link. Please try again.";
    }
} else {
    echo "No account found with that email address."; // If no user found
}
?>
