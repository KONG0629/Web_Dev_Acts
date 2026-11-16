<?php
/*
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
if (isset($_POST["send"])) {

$mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'onebytecadence@gmail.com';   //SMTP write your email
    $mail->Password   = 'ruhe qejh ixyp ruhn';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom( $_POST["email"], $_POST["name"]); // Sender Email and name
    $mail->addAddress('onebytecadence@gmail.com');     //Add a recipient email  
    $mail->addReplyTo($_POST["email"], $_POST["name"]); // reply to sender email

    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = $_POST["subject"];   // email subject headings
    $mail->Body    = $_POST["message"]; //email message

    // Success sent message alert
    $mail->send();
    echo
    " 
    <script> 
    alert('Message was sent successfully!');
    document.location.href = 'index.php';
    </script>
    ";
}*/
?>


<?php
/*
include 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes
require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

// Check if the form is submitted
if (isset($_POST['send'])) {

    $email = $_POST['email'];  // Get the email entered by the user

    // Generate a unique token for the password reset link (using a more secure method)
    $token = bin2hex(random_bytes(16));  // Generates a 32-character long token
    
    // Database connection (example)
    $conn = new mysqli("localhost", "username", "password", "database_name");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the token into a reset_tokens table with an expiration time (e.g., 1 hour)
    $stmt = $conn->prepare("INSERT INTO reset_tokens (email, token, expiration) VALUES (?, ?, ?)");
    $expiration = time() + 3600; // 1 hour from now
    $stmt->bind_param("ssi", $email, $token, $expiration);
    $stmt->execute();
    $stmt->close();

    // Close the database connection
    $conn->close();

    // Create the reset link (this could be an actual link on your site)
    $resetLink = "http://localhost/yourproject/resetpass.php?token=" . $token;

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Use Gmail SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'onebytecadence@gmail.com';  // Your Gmail address
        $mail->Password = 'ruhe qejh ixyp ruhn';  // Your Gmail App password (generated for 2FA)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Use TLS encryption
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('onebytecadence@gmail.com', 'Cadence');  // Sender's email and name
        $mail->addAddress($email);  // Add recipient email from form submission

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Password Reset Request';
        $mail->Body    = "Hello,<br><br>We received a request to reset your password. Please click the link below to reset your password:<br><br><a href=\"$resetLink\">Reset Your Password</a><br><br>If you did not request this, please ignore this email.";

        // Send the email
        $mail->send();

        echo 'A password reset link has been sent to your email.';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}*/
?>




<?php
// Include database connection
include 'db.php';

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Require PHPMailer classes
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$email = $_POST['email']; // Get email from POST request

// Sanitize and validate email input to prevent injection and malicious input
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

    // Check if the email exists in the database
    $sql = "SELECT id FROM userstbl WHERE email = ?";
    if ($stmt = $conn->prepare($sql)) {
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
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("ssi", $tokenHash, $expiry, $userId);
                $stmt->execute();

                // If the token is successfully stored, send the reset email
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
                echo "Error storing reset token. Please try again.";
            }
        } else {
            echo "No account found with that email address."; // If no user found
        }
    } else {
        echo "Database query failed. Please try again later."; // If query fails
    }
} else {
    echo "Invalid email address format."; // If email is not valid
}
?>
