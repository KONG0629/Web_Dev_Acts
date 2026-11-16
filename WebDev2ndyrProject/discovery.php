<?php
session_start();
include 'zbackend/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$tag = isset($_GET['tag']) ? $_GET['tag'] : null;
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : null;

if ($searchTerm) {
    // Filter posts based on the search term
    $sql = "SELECT p.*, 
                (SELECT COUNT(*) FROM likes_post_tbl WHERE post_id = p.post_id) AS like_count 
            FROM poststbl p 
            WHERE post_tag LIKE ? 
            ORDER BY post_publish_date DESC";
    $stmt = $conn->prepare($sql);
    $searchParam = "%$searchTerm%";
    $stmt->bind_param("s", $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();
} elseif ($tag && $tag !== 'All') {
    // Filter posts based on the selected tag
    $sql = "SELECT p.*, 
                (SELECT COUNT(*) FROM likes_post_tbl WHERE post_id = p.post_id) AS like_count 
            FROM poststbl p 
            WHERE post_tag = ? 
            ORDER BY post_publish_date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $tag);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Fetch all posts if no tag or search term is provided
    $sql = "SELECT p.*, 
                (SELECT COUNT(*) FROM likes_post_tbl WHERE post_id = p.post_id) AS like_count 
            FROM poststbl p 
            ORDER BY post_publish_date DESC";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discovery</title>
    <link rel="stylesheet" href="style/discoverys.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div class="container">

        <?php include 'headerall.php'; ?>

        <!-- 1st Content -->
        <div class="contentFirst">
            <div class="blueShape">
                <h1>Discover Stories Written By Authors You Relate With</h1>
            </div>
            <div class="tiltedBlueShape"></div>
        </div>

        <!-- 2nd Content -->
        <div class="contentsecond">
            <div class="searchbtn">
                <form method="get" action="">
                    <input type="search" name="search" class="search" placeholder="Search..." value="<?= htmlspecialchars($searchTerm ?? '') ?>">
                    <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="buttons">
                <a href="?tag=All"><button type="button"><i class="fa-solid fa-mortar-pestle"></i> All</button></a>
                <a href="?tag=Culinary"><button type="button"><i class="fa-solid fa-mortar-pestle"></i> Culinary</button></a>
                <a href="?tag=Music"><button type="button"><i class="fa-solid fa-music"></i> Music</button></a>
                <a href="?tag=Lifestyle"><button type="button"><i class="fa-solid fa-dna"></i> Lifestyle</button></a>
                <a href="?tag=Sports"><button type="button"><i class="fa-solid fa-volleyball"></i> Sports</button></a>
                <a href="?tag=Politics"><button type="button"><i class="fa-solid fa-landmark"></i> Politics</button></a>
            </div>
        </div>

        <!-- 3rd Content: Display All Posts -->
        <div class="contentThird">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($post = $result->fetch_assoc()): ?>
                    <div class="contentT">
                        <div class="contleft">
                            <!-- Wrap the image inside the clickable link -->
                            <a href="postDetails.php?post_id=<?= $post['post_id'] ?>" class="post-link">
                                <img src="<?= htmlspecialchars($post['post_attachment'] ?: 'image/MLogo.png') ?>" alt="Post Image">
                            </a>
                        </div>
                        <div class="conright">
                            <!-- Post title and text are not clickable -->
                            <h1><?= htmlspecialchars($post['post_title']) ?></h1>
                            <p><?= htmlspecialchars($post['post_text']) ?></p>
                            <div class="BTN">
                                <!-- First button: Like (and navigate to postDetails.php) -->
                                    <!-- Like count text (no button) -->
                                    <span class="like-count-text" data-post-id="<?= $post['post_id'] ?>">
                                        <i class="fa-solid fa-user-plus"></i> 
                                        <span id="post-like-count-<?= $post['post_id'] ?>">
                                            <?= htmlspecialchars($post['like_count']) ?>
                                        </span> people Like this
                                    </span>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No posts to display.</p>
            <?php endif; ?>
        </div>

        <!-- 4th Content -->
        <div class="contentfourth">
            <h1>Want to add an entry to the list?</h1>
            <a href="userProfile.php"><button type="button" class="direct-to-page">Start Writing</button></a>
        </div>

        <!-- 5th Content -->
        <div class="contentfifth">
            <div class="confifth">
                <div class="conrightF">
                    <h1>Learn more about us</h1>
                    <p>Discover more about Cadence—our mission, values, and how we’re helping individuals and businesses thrive in the digital world. Explore our innovative solutions, valuable content, and the supportive community we’ve built to inspire your success.</p>
                    <div class="BTNF">
                        <a href="about.php"><button type="button" class="direct-to-page">Click here</button></a>
                    </div>
                </div>
            </div>
        </div>

        <?php include 'footer.php'; ?>

    </div>

    <script src="script/sidebar.js"></script>
    <script>
        // Handle Post Like Button Click
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll('.btn1').forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault(); // Prevent navigation
                    const postId = button.getAttribute('data-post-id');
                    if (postId) {
                        // AJAX request to update post likes
                        fetch(`update_likes.php?post_id=${postId}`)
                            .then(response => response.text())
                            .then(data => {
                                document.getElementById(`post-like-count-${postId}`).textContent = data;
                            });
                    }
                });
            });
        });
    </script>
</body>
</html>
