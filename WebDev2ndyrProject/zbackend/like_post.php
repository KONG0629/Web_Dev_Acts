<?php
// Handle Like Button Action for Posts
if (isset($_POST['like_post'])) {
    $stmt = $conn->prepare("SELECT * FROM likes_post_tbl WHERE post_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If liked, unlike the post
        $stmt = $conn->prepare("DELETE FROM likes_post_tbl WHERE post_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $post_id, $user_id);
        $stmt->execute();
    } else {
        // If not liked, like the post
        $stmt = $conn->prepare("INSERT INTO likes_post_tbl (post_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $post_id, $user_id);
        $stmt->execute();
    }
}

// Fetch updated like count
$stmt = $conn->prepare("SELECT COUNT(*) AS like_count FROM likes_post_tbl WHERE post_id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$like_count_result = $stmt->get_result()->fetch_assoc();
$like_count = $like_count_result['like_count'];
?>
