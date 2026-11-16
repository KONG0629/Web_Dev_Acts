<?php
session_start();
include 'zbackend/db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch user profile data
$profile_stmt = $conn->prepare("SELECT email, username, author_name, page_title, description, profile_icon 
                                FROM profiletbl WHERE user_id = ?");
$profile_stmt->bind_param("i", $user_id);
$profile_stmt->execute();
$profile_result = $profile_stmt->get_result();
$user = $profile_result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Draft</title>
    <link rel="stylesheet" href="style/create-posts.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="overlay" id="overlay">
        <div class="container">
            <button class="exit-button" id="exit-button"><i class="fa-solid fa-chevron-left"></i>Create a new post</button>
            <div class="profile">
                <img src="<?= !empty($user['profile_icon']) ? htmlspecialchars($user['profile_icon']) : 'image/default-icon.jpg' ?>">
                <div class="details">
                    <p><?= htmlspecialchars($user['author_name'] ?? 'N/A') ?></p>
                    <h1><?= htmlspecialchars($user['page_title'] ?? 'N/A') ?></h1>
                </div>
            </div>
            
            <form method="POST" enctype="multipart/form-data">
                <div class="input-wrapper">
                    <input type="text" name="title" placeholder=" " required>
                    <div class="styled-placeholder">
                        Title<span>*</span>
                    </div>
                </div>

                <select name="tags" required>
                    <option value="" selected disabled>Tags*</option>
                    <option value="culinary">Culinary</option>
                    <option value="music">Music</option>
                    <option value="lifestyle">LifeStyle</option>
                    <option value="sports">Sports</option>
                    <option value="politics">Politics</option>
                </select>

                <div class="textarea-ui">
                    <div class="textarea-wrapper">
                        <textarea id="textarea" name="body" placeholder=" " required></textarea>
                        <div class="styled-placeholder">
                            Body<span>*</span>
                        </div>
                    </div>
                </div>
                
                <div class="create-post-footer">
                    <div class="custom-file-upload">
                        <input type="file" id="file-input" name="image" style="display: none;" accept="image/*,video/*,.gif" onchange="updateFileName()" />
                        <button type="button" id="open-file-explorer" class="upload-button" onclick="document.getElementById('file-input').click()">Upload an image</button>
                        <div class="file-name-container" id="file-name">No image uploaded</div>
                    </div>
                    <div class="decision-buttons">
                        <button type="submit" class="draft-button" name="action" value="draft">Save as draft</button>
                        <button type="submit" class="publish-button" name="action" value="publish">Publish now</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
