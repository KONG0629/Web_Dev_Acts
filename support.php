<?php

include ('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $assistance = $_POST['assistance'];
    $email = $_POST['email'];
    $issue = $_POST['issue'];
    $subject = $_POST['subject'];
    $detail = $_POST['detail'];

    $attachment = '';
    if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] == 0) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $attachment = $uploadDir . basename($_FILES['attachment']['name']);
        move_uploaded_file($_FILES['attachment']['tmp_name'], $attachment);
    }

    // Check if the user exists in the database
    $sql = "SELECT id FROM userstbl WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        // Insert the support request into the database
        $sql = "INSERT INTO supporttbl (user_id, assistance, email, issue, subject, detail, attachment)
                VALUES ('$user_id', '$assistance', '$email', '$issue', '$subject', '$detail', '$attachment')";

        if ($conn->query($sql) === TRUE) {
            echo "<script> alert('Report submitted successfully!'); </script>";
        } else {
            echo "<script> alert('Error: " . $conn->error . "'); </script>";
        }
    } else {
        echo "<script> alert('Error: Email address not found in the users database.'); </script>";
    }
}

?>



<?php 

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login.php if not logged in
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Form</title>
    <link rel="stylesheet" href="style/support.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container">




    <?php include 'headerall.php'; ?>





<div class="requestHeader">

    <div class="blueShape">
        <h1>Submit a Request</h1>
    </div>

    <div class="tiltedBlueShape"></div>
</div>

<div class="requestTooltip">
    <div class="bulletPoint">
        <p>•</p>
    </div>
    <div>
        <p>
            We're here to help! Please fill out the form below to submit your concern or 
            request, and our support team will get back to you as soon as possible.
        </p>
    </div>
</div>
<form action="support.php" method="POST" enctype="multipart/form-data">

    <label for="assistance">What do you need assistance with?</label><br>
    <input type="text" name="assistance"><br>
    <label for="email">Your email address</label><br>
    <input type="email" name="email"><br>
    <label for="issue">What type of account issue are occuring?</label><br>
    <input type="text" name="issue"><br>
    <label for="subject">Subject of inquiry</label><br>
    <input type="text" name="subject"><br>
    <label for="detail">Details of inquiry</label><br>
    <textarea name="detail" rows="15"></textarea>
    <label for="attachment">Attachment (optional)</label><br>
    <div class="fileUpload" id="fileUploadArea">
        <label for="attachment"><u>add file</u></label><br>
        <input type="file" name="attachment" id="fileUpload"><br>
    </div>
    <button type="submit" class="submitButton">Submit</button>
    
</form>





<?php include 'footer.php'; ?>





</div>

    <script src="script/sidebar.js"></script>
    <script src="script/reqform.js"></script>

    
</body>
</html>