<?php
session_start();
include 'zbackend/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = $_POST['post_id'];
$comment_text = $_POST['comment_text'];

// Insert the comment into the database
$stmt = $conn->prepare("INSERT INTO comments_tbl (post_id, user_id, comment_text) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $post_id, $user_id, $comment_text);
$stmt->execute();

// Get the updated comment count
$stmt = $conn->prepare("SELECT COUNT(*) AS comment_count FROM comments_tbl WHERE post_id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$comment_count_result = $stmt->get_result()->fetch_assoc();

echo json_encode([
    'success' => true,
    'comment_count' => $comment_count_result['comment_count']
]);
?>
