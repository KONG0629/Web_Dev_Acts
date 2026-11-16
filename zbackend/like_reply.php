<?php
include 'db.php';
$data = json_decode(file_get_contents('php://input'), true);

$reply_id = $data['reply_id'];
$like = $data['like'] ? 1 : 0;
$user_id = $_SESSION['user_id']; // Assuming the user is logged in

// Check if the user already liked the reply
$stmt = $conn->prepare("SELECT * FROM likes_reply_tbl WHERE reply_id = ? AND user_id = ?");
$stmt->bind_param("ii", $reply_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User already liked, so remove like (unlike)
    if (!$like) {
        $stmt = $conn->prepare("DELETE FROM likes_reply_tbl WHERE reply_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $reply_id, $user_id);
        $stmt->execute();
    }
} else {
    // User hasn't liked yet, so add like
    if ($like) {
        $stmt = $conn->prepare("INSERT INTO likes_reply_tbl (reply_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $reply_id, $user_id);
        $stmt->execute();
    }
}

// Update the reply's like count
$stmt = $conn->prepare("SELECT COUNT(*) AS like_count FROM likes_reply_tbl WHERE reply_id = ?");
$stmt->bind_param("i", $reply_id);
$stmt->execute();
$like_count_result = $stmt->get_result()->fetch_assoc();

echo json_encode(['like_count' => $like_count_result['like_count']]);
?>
