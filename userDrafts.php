<?php
session_start();
include 'zbackend/db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch drafts for the logged-in user
$drafts_query = $conn->prepare("SELECT draft_id, draft_title, draft_text, draft_attachment, draft_tag FROM draftstbl WHERE user_id = ?");
$drafts_query->bind_param("i", $user_id);
$drafts_query->execute();
$drafts_result = $drafts_query->get_result();

$post_stmt = $conn->prepare("SELECT post_title, post_text, post_attachment, post_publish_date, post_likes, post_comments 
                             FROM poststbl WHERE user_id = ? ORDER BY post_publish_date DESC");
$post_stmt->bind_param("i", $user_id);
$post_stmt->execute();
$post_result = $post_stmt->get_result();

// Fetch user profile data
$profile_stmt = $conn->prepare("SELECT email, username, author_name, page_title, description, profile_icon 
                                FROM profiletbl WHERE user_id = ?");
$profile_stmt->bind_param("i", $user_id);
$profile_stmt->execute();
$profile_result = $profile_stmt->get_result();
$user = $profile_result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $tag = $_POST['tags'];
    $body = $_POST['body'];
    $action = $_POST['action'];
    $existing_image = $_POST['image_path'] ?? ''; // Get the hidden input value
    $image = $existing_image; // Default to the existing image

    // Step 1: Handle image upload first
    if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] == 0) {
        $target_dir = "uploads/";

        // Ensure the uploads directory exists
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
        }

        // Generate a new image path based on the uploaded file
        $image = $target_dir . time() . "_" . basename($_FILES["image"]["name"]);

        // Step 2: Move the uploaded file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
            // If there is an existing image, delete the old one
            if (!empty($existing_image) && file_exists($existing_image)) {
                unlink($existing_image);
            }
        } else {
            // If the upload fails, retain the existing image (if any)
            $image = $existing_image;
        }
    } else {
        // If no new image is uploaded, retain the existing image
        $image = $existing_image;
    }

    // Step 3: Insert or update the draft record in the database
    if ($action === 'draft') {
        // Insert or update draft logic
        $stmt = $conn->prepare("INSERT INTO draftstbl (user_id, draft_title, draft_text, draft_attachment, draft_tag) 
                                VALUES (?, ?, ?, ?, ?) 
                                ON DUPLICATE KEY UPDATE 
                                    draft_title = VALUES(draft_title), 
                                    draft_text = VALUES(draft_text), 
                                    draft_attachment = VALUES(draft_attachment), 
                                    draft_tag = VALUES(draft_tag)");
        $stmt->bind_param("issss", $user_id, $title, $body, $image, $tag);
        $stmt->execute();
    } elseif ($action === 'publish') {
        // Publish post logic
        $publish_date = date("Y-m-d H:i:s");
        $stmt = $conn->prepare("INSERT INTO poststbl (user_id, post_title, post_text, post_attachment, post_publish_date, post_tag) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $user_id, $title, $body, $image, $publish_date, $tag);

        if ($stmt->execute()) {
            // Delete draft after publishing
            $delete_stmt = $conn->prepare("DELETE FROM draftstbl WHERE user_id = ? AND draft_title = ?");
            $delete_stmt->bind_param("is", $user_id, $title);
            $delete_stmt->execute();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Drafts</title>
    <link rel="stylesheet" href="style/userDrafts.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <?php include 'headerall.php'; ?>

        <div class="draft-container">
            <a href="userProfile.php"><button class="return-btn"><i class="fa-solid fa-chevron-left"></i>Back to profile page</button></a>
            <div class="profile">
                <img src="<?= !empty($user['profile_icon']) ? htmlspecialchars($user['profile_icon']) : 'image/default-icon.jpg' ?>">
                <div class="details">
                    <p><?= htmlspecialchars($user['author_name'] ?? 'N/A') ?></p>
                    <h1><?= htmlspecialchars($user['page_title'] ?? 'N/A') ?></h1>
                </div>
            </div>
            <table>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Attachment</th>
        <th>Tag</th>
    </tr>
    <?php
    if ($drafts_result->num_rows > 0) {
        while ($row = $drafts_result->fetch_assoc()) {
            echo "<tr>";
            // Adding the 'edit-draft' class to the link and embedding data attributes
            echo "<td><a href='#' class='edit-draft' 
                data-draft-id='" . $row['draft_id'] . "' 
                data-title='" . htmlspecialchars($row['draft_title']) . "' 
                data-text='" . htmlspecialchars($row['draft_text']) . "' 
                data-tag='" . htmlspecialchars($row['draft_tag']) . "' 
                data-attachment='" . htmlspecialchars($row['draft_attachment']) . "'>
                " . htmlspecialchars($row['draft_title']) . "
            </a></td>";
            echo "<td>" . htmlspecialchars($row['draft_text']) . "</td>";
            if (!empty($row['draft_attachment'])) {
                echo "<td><a href='" . htmlspecialchars($row['draft_attachment']) . "' target='_blank'>" . htmlspecialchars(basename($row['draft_attachment'])) . "</a></td>";
            } else {
                echo "<td>No Attachment</td>";
            }
            echo "<td>" . htmlspecialchars($row['draft_tag']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No drafts found</td></tr>";
    }
    ?>
</table>

        </div>

        <div id="display"></div>

        <?php include 'footer.php'; ?>
    </div>
    

    <script src="script/edit-draft.js"></script>
</body>
</html>