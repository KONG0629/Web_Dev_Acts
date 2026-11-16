<?php
include 'zbackend/postDetailsBack.php'; // Include the backend logic

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['like_post'])) {
        $user_id = $_SESSION['user_id'];
        $post_id = $_GET['post_id'];
    
        $check_like_stmt = $conn->prepare("SELECT COUNT(*) AS like_count FROM post_likes_tbl WHERE user_id = ? AND post_id = ?");
        $check_like_stmt->bind_param("ii", $user_id, $post_id);
        $check_like_stmt->execute();
        $result = $check_like_stmt->get_result()->fetch_assoc();
    
        if ($result['like_count'] == 0) {
            $insert_like_stmt = $conn->prepare("INSERT INTO post_likes_tbl (user_id, post_id) VALUES (?, ?)");
            $insert_like_stmt->bind_param("ii", $user_id, $post_id);
            $insert_like_stmt->execute();
    
            $update_like_stmt = $conn->prepare("UPDATE poststbl SET post_likes = post_likes + 1 WHERE post_id = ?");
            $update_like_stmt->bind_param("i", $post_id);
            $update_like_stmt->execute();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['post_title']) ?> - Post Details</title>
    <link rel="stylesheet" href="style/postDetails.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <?php include 'headerall.php'; ?>

        <div class="contentCol">
            <div class="content">
                <!-- Author Profile Section -->
                <div class="profile">
                    <img src="<?= !empty($author['profile_icon']) ? htmlspecialchars($author['profile_icon']) : 'image/default-icon.jpg' ?>" alt="Profile Picture">
                    <h1><?= htmlspecialchars($author['author_name']) ?></h1>
                </div>

                <!-- Post Section -->
                <div class="head">
                    <h1><?= htmlspecialchars($post['post_title']) ?></h1>
                </div>

                <div class="paragraph1">
                    <p><?= htmlspecialchars($post['post_text']) ?></p>
                </div>

                <div class="pic">
                    <?php if (!empty($post['post_attachment'])): ?>
                        <img src="<?= htmlspecialchars($post['post_attachment']) ?>" alt="Post Attachment">
                    <?php endif; ?>
                </div>

                <!-- Like/Comment Section -->
                <div class="icon2" id="comment-icon">
                    <div class="left2">
                        <!-- Like Button -->
                        <form method="POST">
                            <button type="submit" name="like_post" class="like-button">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </form>
                        <span id="post-like-count"><?= htmlspecialchars($like_count) ?></span>

                        <!-- Comment Button -->
                        <i class="fa-regular fa-comment"></i>
                        <span id="comment-count"><?= htmlspecialchars($comment_count) ?></span>
                    </div>
                </div>

                <!-- Comment Section -->
                <div class="comment-section" id="comment-section">
                    <div id="comments-list">
                        <!-- Display existing comments with author details -->
                        <?php
                        $comments_stmt = $conn->prepare("SELECT c.comment_id, c.comment_text, u.author_name, u.profile_icon 
                                                        FROM comments_tbl c 
                                                        JOIN profiletbl u ON c.user_id = u.user_id 
                                                        WHERE c.post_id = ?");
                        $comments_stmt->bind_param("i", $post_id);
                        $comments_stmt->execute();
                        $comments_result = $comments_stmt->get_result();

                        while ($comment = $comments_result->fetch_assoc()) {
                            // Get like count for the comment
                            $comment_like_stmt = $conn->prepare("SELECT COUNT(*) AS like_count FROM likes_comment_tbl WHERE comment_id = ?");
                            $comment_like_stmt->bind_param("i", $comment['comment_id']);
                            $comment_like_stmt->execute();
                            $comment_like_count_result = $comment_like_stmt->get_result()->fetch_assoc();
                            $comment_like_count = $comment_like_count_result['like_count'];

                            echo "<div class='comment'>
                                    <div class='comment-author'>
                                        <img src='" . (!empty($comment['profile_icon']) ? htmlspecialchars($comment['profile_icon']) : 'image/default-icon.jpg') . "' alt='Author Icon' class='comment-icon'>
                                        <strong>" . htmlspecialchars($comment['author_name']) . "</strong>
                                    </div>
                                    <p class='comment-text'>" . htmlspecialchars($comment['comment_text']) . "</p>

                                    <!-- Like Button for Comment -->
                                    <form method='POST'>
                                        <input type='hidden' name='comment_id' value='" . $comment['comment_id'] . "'>
                                        <button type='submit' name='like_comment' class='like-comment-btn'>
                                            <i class='fa-regular fa-heart'></i> Like
                                        </button>
                                    </form>
                                    <span id='comment-like-count'>" . $comment_like_count . "</span>
                                  </div>";

                            // Fetch replies for this comment
                            $replies_stmt = $conn->prepare("SELECT r.reply_id, r.reply_text, u.author_name, u.profile_icon
                                                            FROM replies_tbl r
                                                            JOIN profiletbl u ON r.user_id = u.user_id
                                                            WHERE r.comment_id = ?");
                            $replies_stmt->bind_param("i", $comment['comment_id']);
                            $replies_stmt->execute();
                            $replies_result = $replies_stmt->get_result();

                            while ($reply = $replies_result->fetch_assoc()) {
                                // Get like count for the reply
                                $reply_like_stmt = $conn->prepare("SELECT COUNT(*) AS like_count FROM likes_reply_tbl WHERE reply_id = ?");
                                $reply_like_stmt->bind_param("i", $reply['reply_id']);
                                $reply_like_stmt->execute();
                                $reply_like_count_result = $reply_like_stmt->get_result()->fetch_assoc();
                                $reply_like_count = $reply_like_count_result['like_count'];

                                echo "<div class='reply'>
                                        <div class='reply-author'>
                                            <img src='" . (!empty($reply['profile_icon']) ? htmlspecialchars($reply['profile_icon']) : 'image/default-icon.jpg') . "' alt='Reply Author Icon' class='comment-icon'>
                                            <strong>" . htmlspecialchars($reply['author_name']) . "</strong>
                                        </div>
                                        <p class='reply-text'>" . htmlspecialchars($reply['reply_text']) . "</p>

                                        <!-- Like Button for Reply -->
                                        <form method='POST'>
                                            <input type='hidden' name='reply_id' value='" . $reply['reply_id'] . "'>
                                            <button type='submit' name='like_reply' class='like-reply-btn'>
                                                <i class='fa-regular fa-heart'></i> Like
                                            </button>
                                        </form>
                                        <span id='reply-like-count'>" . $reply_like_count . "</span>
                                      </div>";
                            }

                            // Reply form
                            echo "<div class='reply-form'>
                                    <form method='POST'>
                                        <textarea name='reply_text' placeholder='Reply to this comment...' rows='3'></textarea>
                                        <input type='hidden' name='comment_id' value='" . $comment['comment_id'] . "'>
                                        <button type='submit' name='reply' class='submit-reply-btn'>Reply</button>
                                    </form>
                                  </div>";
                        }
                        ?>
                    </div>

                    <div class="new-comment">
                        <form method="POST">
                            <textarea id="new-comment" name="comment_text" placeholder="Write a comment..." rows="3"></textarea>
                            <button type="submit" name="comment" class="submit-btn">Post Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
