<?php
include 'db.php';
$data = json_decode(file_get_contents('php://input'), true);

$comment_id = $data['comment_id'];
$reply_text = $data['reply_text'];
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("INSERT INTO replies_tbl (comment_id, user_id, reply_text) VALUES (?, ?, ?)");
$stmt->bind_param("iis", $comment_id, $user_id, $reply_text);
$stmt->execute();

$reply_id = $stmt->insert_id;

// Fetch the updated reply count
$stmt = $conn->prepare("SELECT COUNT(*) AS reply_count FROM replies_tbl WHERE comment_id = ?");
$stmt->bind_param("i", $comment_id);
$stmt->execute();
$reply_count_result = $stmt->get_result()->fetch_assoc();

echo json_encode([
    'success' => true,
    'reply_id' => $reply_id,
    'reply_text' => $reply_text,
    'reply_count' => $reply_count_result['reply_count']
]);
?>
