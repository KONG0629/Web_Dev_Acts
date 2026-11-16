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

// Fetch user posts
$post_stmt = $conn->prepare("SELECT post_id, post_title, post_text, post_attachment, post_publish_date, post_likes, post_comments 
                            FROM poststbl WHERE user_id = ? ORDER BY post_publish_date DESC");
$post_stmt->bind_param("i", $user_id);
$post_stmt->execute();
$post_result = $post_stmt->get_result();

// Handle delete post logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_post'])) {
    $post_id_to_delete = $_POST['delete_post']; // Get the post ID from the form
    $delete_posts_stmt = $conn->prepare("DELETE FROM poststbl WHERE post_id = ?");
    $delete_posts_stmt->bind_param("i", $post_id_to_delete);
    $delete_posts_stmt->execute();
}


// Function to fetch the like count for a post
function get_like_count($post_id) {
    global $conn;
    $like_count_stmt = $conn->prepare("SELECT COUNT(*) AS like_count FROM likes_post_tbl WHERE post_id = ?");
    $like_count_stmt->bind_param("i", $post_id);
    $like_count_stmt->execute();
    $like_count_result = $like_count_stmt->get_result()->fetch_assoc();
    return $like_count_result['like_count'];
}

// Function to fetch the comment count for a post
function get_comment_count($post_id) {
    global $conn;
    $comment_count_stmt = $conn->prepare("SELECT COUNT(*) AS comment_count FROM comments_tbl WHERE post_id = ?");
    $comment_count_stmt->bind_param("i", $post_id);
    $comment_count_stmt->execute();
    $comment_count_result = $comment_count_stmt->get_result()->fetch_assoc();
    return $comment_count_result['comment_count'];
}

// Time elapsed function
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = [
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    ];
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Management Overview</title>
    <link rel="stylesheet" href="style/managements.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container">




    <?php include 'headerall.php'; ?>








        <div class="management">
            <div class="profile">
                <div class="userDetails">
                    <div class="userImageName">
                        <img src="<?= !empty($user['profile_icon']) ? htmlspecialchars($user['profile_icon']) : 'image/default-icon.jpg' ?>" alt="Profile Picture">
                        <div class="usernameHeader">
                            <p><?= htmlspecialchars($user['author_name'] ?? 'N/A') ?></p>
                            <p><b><?= htmlspecialchars($user['page_title'] ?? 'N/A') ?></b></p>
                        </div>
                    </div>
                    <div class="numericalContainer">
                        <div class="numericalDetails">
                            <p class="numericalHighlight">69</p>
                            <p>Articles<br>Written</p>
                        </div>
                        <div class="numericalDetails">
                            <p class="numericalHighlight">420</p>
                            <p>Comments<br>Received</p>
                        </div>
                        <div class="numericalDetails">
                            <p class="numericalHighlight">10/20/1999</p>
                            <p>Join Date<br>(mm/dd/yyyy)</p>
                        </div>
                    </div>
                </div>
                <div class="profileSecurity">
                    <a href="userSettings.php" style="text-decoration: none;"><div class="bigButton1">
                        <i class="fa-solid fa-pen"></i>
                        <p>Edit profile</p>
                    </div></a>
                    <a href="userAccount.php" style="text-decoration: none;"><div class="bigButton2">
                        <i class="fa-solid fa-shield"></i>
                        <p>Security</p>
                    </div></a>
                </div>
            </div>
            <hr>
            <h1>Post Management Overview</h1>
            <div class="settingsWarning">
                <h1 class="redExclamationPoint">!</h1>
                <p>Changes you make here are visible to your page</p>
            </div>
            <hr>
            <div class="managementFunctions">
                <div class="mainFunctions">
                    <button type="button" class="navigationButton">Sort&ensp;<i class="fa-solid fa-bars"></i></button>
                    <button type="button" class="navigationButton">Category&ensp;<i class="fa-solid fa-shapes"></i></button>
                </div>
                <div class="subFunctions">
                    <button type="button" class="smallNavigationButton">Published</button>
                    <button type="button" class="smallNavigationButton">Private</button>
                    <button type="button" class="smallNavigationButton">New <span class="redDot">•</span></button>
                </div>
            </div>
            <hr>
            <?php while ($post = $post_result->fetch_assoc()): ?>
                <?php 
                    $like_count = get_like_count($post['post_id']);
                    $comment_count = get_comment_count($post['post_id']);
                ?>
            <div class="postContainer">
                <div class="postTextContainer">
                    <p><span class="postTitle"><a href="postDetails.php?post_id=<?= $post['post_id'] ?>"><?= htmlspecialchars($post['post_title']) ?></a></span> • <?= time_elapsed_string($post['post_publish_date']) ?></p>
                    <p><?= htmlspecialchars($post['post_text']) ?></p>
                </div>
                <div class="interractiveIcons">
                    <div class="blueIcons">
                        <p>
                            <i class="fa-regular fa-heart"></i> <span id="like-count-<?= $post['post_id'] ?>"><?= $like_count ?></span>&ensp;
                            <i class="fa-regular fa-comment"></i> <span id="comment-count-<?= $post['post_id'] ?>"><?= $comment_count ?></span>
                        </p>
                    </div>
                    <form method="POST" action="management.php">
                        <div class="redIcons">
                            <p>
                                <button type="submit" class="redIcons" name="delete_post" value="<?= $post['post_id'] ?>"><i class="fa-regular fa-trash-can"></i></button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
            <?php endwhile; ?>
        </div>



        
        
        <?php include 'footer.php'; ?>




    </div>

    
</body>
</html>