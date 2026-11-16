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

// Handle create post (publish or draft) logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $tag = $_POST['tags'];
    $body = $_POST['body'];
    $action = $_POST['action'];
    $image = null;

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "uploads/";

        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $image = $target_dir . time() . "_" . basename($_FILES["image"]["name"]);

        // Move uploaded file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $image)) {
            $image = $conn->real_escape_string($image);
        } else {
            $image = null;
        }
    }

    // If action is 'draft'
    if ($action === 'draft') {
        $stmt = $conn->prepare("INSERT INTO draftstbl (user_id, draft_title, draft_text, draft_attachment, draft_tag) 
                                VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $user_id, $title, $body, $image, $tag);
        if ($stmt->execute()) {
        } else {
            echo "Error: " . $conn->error;
        }
        exit();
    }

    // If action is 'publish'
    if ($action === 'publish') {
        $publish_date = date("Y-m-d H:i:s");

        $stmt = $conn->prepare("INSERT INTO poststbl (user_id, post_title, post_text, post_attachment, post_publish_date, post_tag) 
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $user_id, $title, $body, $image, $publish_date, $tag);
        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
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
    <title>Profile</title>
    <link rel="stylesheet" href="style/userProfiles.css">
    <link rel="stylesheet" href="style/create-posts.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

<div class="container">

    <?php include 'headerall.php'; ?>

    <div class="profileContainer">
        <div class="profilePicture">
            <img src="<?= !empty($user['profile_icon']) ? htmlspecialchars($user['profile_icon']) : 'image/default-icon.jpg' ?>">
        </div>

        <div class="profileDetails">
            <h1><?= htmlspecialchars($user['author_name'] ?? 'N/A') ?></h1>
            <h2><?= htmlspecialchars($user['page_title'] ?? 'N/A') ?></h2>
            <div class="profileNavigation">
            </div>
        </div>
    </div>

    <div class="marginLine">
        <hr>
        <div class="profileFunctions">
            <button type="button" class="createPost" id="create-post-on"><i class="fa-solid fa-plus"></i>&ensp;Create post</button>
            <a href="userDrafts.php"><button type="button" class="sortButton">Drafts</button></a>
            <a href="management.php"><button type="button" class="sortButton">Manage</button></a>
            <a href="userSettings.php"><button type="button" class="sortButton">Settings <i class="fa-solid fa-gear"></i></button></a>

            </div>
        <hr>
    </div>

    <div class="mediaContainer">
        <div class="posts">
        <?php while ($post = $post_result->fetch_assoc()): ?>
            <?php 
                $like_count = get_like_count($post['post_id']);
                $comment_count = get_comment_count($post['post_id']);
            ?>
            <div class="singlePost">
                <div class="postHeader">
                    <div class="postTitle">
                        <p><b>
                            <a href="postDetails.php?post_id=<?= $post['post_id'] ?>"><?= htmlspecialchars($post['post_title']) ?></a>
                        </b> • <?= time_elapsed_string($post['post_publish_date']) ?></p>
                    </div>
                    <div class="viewsComments">
                        <p>
                            <!-- Displaying Like count -->
                            <i class="fa-regular fa-heart"></i>
                            <span id="like-count-<?= $post['post_id'] ?>"><?= $like_count ?></span> 

                            <!-- Displaying Comment count -->
                            <i class="fa-regular fa-comment"></i>
                            <span id="comment-count-<?= $post['post_id'] ?>"><?= $comment_count ?></span>
                        </p>
                    </div>
                </div>

                <p><?= htmlspecialchars($post['post_text']) ?></p>

                <?php if (!empty($post['post_attachment'])): ?>
                    <img src="<?= htmlspecialchars($post['post_attachment']) ?>" alt="Post Attachment">
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    </div>

        <div class="about">
            <div class="singleAbout">
                <div class="aboutHeader">
                    <div class="followCount">
                        <p><i class="fa-solid fa-user-group"></i> 118.4k people follow this</p>
                    </div>
                    <button type="button" class="followButton"><i class="fa-solid fa-plus"></i></button>
                </div>
                <h3>About</h3>
                <p><?= htmlspecialchars($user['description'] ?? 'N/A') ?></p>
                <hr>
                <div class="aboutDetails">
                    <div>
                        <p><b>68</b><br>Articles<br>Written</p>
                    </div>
                    <div>
                        <p><b>79.2k</b><br>Comments<br>Received</p>
                    </div>
                    <div>
                        <p><b>12/13/2019</b><br>Join Date<br>(mm/dd/yyyy)</p>
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>

    <div id="display"></div>

    <?php include 'footer.php'; ?>

</div>

<script src="script/create-post.js"></script>

</body>
</html>
