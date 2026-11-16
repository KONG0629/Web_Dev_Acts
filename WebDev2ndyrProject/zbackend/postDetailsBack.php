<?php
session_start();
include 'zbackend/db.php';

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Logged-in user ID

// Fetch post details
$post_id = $_GET['post_id'];
$stmt = $conn->prepare("SELECT * FROM poststbl WHERE post_id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$post = $stmt->get_result()->fetch_assoc();

if (!$post) {
    die("Post not found");
}

// Fetch post author's profile data
$author_id = $post['user_id'];
$author_stmt = $conn->prepare("SELECT author_name, profile_icon FROM profiletbl WHERE user_id = ?");
$author_stmt->bind_param("i", $author_id);
$author_stmt->execute();
$author_result = $author_stmt->get_result();
$author = $author_result->fetch_assoc();

// Handle Like Button for Post
if (isset($_POST['like_post'])) {
    $like_check_stmt = $conn->prepare("SELECT * FROM likes_post_tbl WHERE post_id = ? AND user_id = ?");
    $like_check_stmt->bind_param("ii", $post_id, $user_id);
    $like_check_stmt->execute();
    $like_result = $like_check_stmt->get_result();

    if ($like_result->num_rows > 0) {
        // Unlike the post
        $unlike_stmt = $conn->prepare("DELETE FROM likes_post_tbl WHERE post_id = ? AND user_id = ?");
        $unlike_stmt->bind_param("ii", $post_id, $user_id);
        $unlike_stmt->execute();
    } else {
        // Like the post
        $like_stmt = $conn->prepare("INSERT INTO likes_post_tbl (post_id, user_id) VALUES (?, ?)");
        $like_stmt->bind_param("ii", $post_id, $user_id);
        $like_stmt->execute();
    }
}

// Handle Like Button for Comments
if (isset($_POST['like_comment'])) {
    $comment_id = $_POST['comment_id'];
    $like_check_stmt = $conn->prepare("SELECT * FROM likes_comment_tbl WHERE comment_id = ? AND user_id = ?");
    $like_check_stmt->bind_param("ii", $comment_id, $user_id);
    $like_check_stmt->execute();
    $like_result = $like_check_stmt->get_result();

    if ($like_result->num_rows > 0) {
        // Unlike the comment
        $unlike_stmt = $conn->prepare("DELETE FROM likes_comment_tbl WHERE comment_id = ? AND user_id = ?");
        $unlike_stmt->bind_param("ii", $comment_id, $user_id);
        $unlike_stmt->execute();
    } else {
        // Like the comment
        $like_stmt = $conn->prepare("INSERT INTO likes_comment_tbl (comment_id, user_id) VALUES (?, ?)");
        $like_stmt->bind_param("ii", $comment_id, $user_id);
        $like_stmt->execute();
    }
}

// Handle Like Button for Replies
if (isset($_POST['like_reply'])) {
    $reply_id = $_POST['reply_id'];
    $like_check_stmt = $conn->prepare("SELECT * FROM likes_reply_tbl WHERE reply_id = ? AND user_id = ?");
    $like_check_stmt->bind_param("ii", $reply_id, $user_id);
    $like_check_stmt->execute();
    $like_result = $like_check_stmt->get_result();

    if ($like_result->num_rows > 0) {
        // Unlike the reply
        $unlike_stmt = $conn->prepare("DELETE FROM likes_reply_tbl WHERE reply_id = ? AND user_id = ?");
        $unlike_stmt->bind_param("ii", $reply_id, $user_id);
        $unlike_stmt->execute();
    } else {
        // Like the reply
        $like_stmt = $conn->prepare("INSERT INTO likes_reply_tbl (reply_id, user_id) VALUES (?, ?)");
        $like_stmt->bind_param("ii", $reply_id, $user_id);
        $like_stmt->execute();
    }
}

// Handle Comment Submission
if (isset($_POST['comment'])) {
    $comment_text = $_POST['comment_text'];
    if (!empty($comment_text)) {
        $comment_stmt = $conn->prepare("INSERT INTO comments_tbl (post_id, user_id, comment_text) VALUES (?, ?, ?)");
        $comment_stmt->bind_param("iis", $post_id, $user_id, $comment_text);
        $comment_stmt->execute();
    }
}

// Handle Reply Submission
if (isset($_POST['reply'])) {
    $comment_id = $_POST['comment_id'];
    $reply_text = $_POST['reply_text'];
    if (!empty($reply_text)) {
        $reply_stmt = $conn->prepare("INSERT INTO replies_tbl (comment_id, user_id, reply_text) VALUES (?, ?, ?)");
        $reply_stmt->bind_param("iis", $comment_id, $user_id, $reply_text);
        $reply_stmt->execute();
    }
}

// Fetch updated like counts for the post
$like_count_stmt = $conn->prepare("SELECT COUNT(*) AS like_count FROM likes_post_tbl WHERE post_id = ?");
$like_count_stmt->bind_param("i", $post_id);
$like_count_stmt->execute();
$like_count_result = $like_count_stmt->get_result()->fetch_assoc();
$like_count = $like_count_result['like_count'];

// Fetch comment and reply counts
$comment_and_reply_count_stmt = $conn->prepare("SELECT 
                                                    COUNT(c.comment_id) AS comment_count, 
                                                    COUNT(r.reply_id) AS reply_count
                                                FROM comments_tbl c 
                                                LEFT JOIN replies_tbl r ON c.comment_id = r.comment_id
                                                WHERE c.post_id = ?");
$comment_and_reply_count_stmt->bind_param("i", $post_id);
$comment_and_reply_count_stmt->execute();
$comment_and_reply_count_result = $comment_and_reply_count_stmt->get_result()->fetch_assoc();
$comment_count = $comment_and_reply_count_result['comment_count'] + $comment_and_reply_count_result['reply_count'];
?>
