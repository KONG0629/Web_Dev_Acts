// Handle Like Button Action for Comments
if (isset($_POST['like_comment'])) {
    $comment_id = $_POST['like_comment'];

    // Check if the user has already liked this comment
    $stmt = $conn->prepare("SELECT * FROM likes_comment_tbl WHERE comment_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $comment_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If liked, unlike the comment
        $stmt = $conn->prepare("DELETE FROM likes_comment_tbl WHERE comment_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $comment_id, $user_id);
        $stmt->execute();
    } else {
        // If not liked, like the comment
        $stmt = $conn->prepare("INSERT INTO likes_comment_tbl (comment_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $comment_id, $user_id);
        $stmt->execute();
    }
}
