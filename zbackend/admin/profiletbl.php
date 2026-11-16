<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profiles</title>

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="style/profiletbl.css">
    <link rel="stylesheet" href="style/admin.css">
</head>
<body>


<div class="nav_sidebar" id="sidebar" style="background-color:#1a2130">
<span class="toggle-btn p-2 fs-2" onclick="toggleSidebar()">&#9776;</span>
    <a class="mb-2 mt-5" href="dashboard.php">Dashboard</a> 
    <a class="mb-2" href="index.php">Accounts</a> 
    <a class="mb-2" href="profiletbl.php">Profile</a>
    <a class="mb-2" href="support.php">Support</a>
    <a class="mb-2" href="/system/php/login.php">Logout</a>
    </div>


<div class="content" id="content">
    <div class="header text-center mb-5 p-3 text-white" style="background-color:#1a2130"><h1>PROFILE MANAGEMENT</h1></div>

    <div class="container">
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                ' . $msg . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
        ?>

        

        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Author Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Page Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Profile Icon</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "dbconn.php"; // Database connection
                $sql = "SELECT `id`, `user_id`, `author_name`, `username`, `page_title`, `description`, `profile_icon` FROM `profiletbl`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td> <?php echo $row['id']; ?></td>
                        <td> <?php echo $row['user_id']; ?></td>
                        <td> <?php echo $row['author_name']; ?></td>
                        <td> <?php echo $row['username']; ?></td>
                        <td> <?php echo $row['page_title']; ?></td>
                        <td> <?php echo $row['description']; ?></td>
                        <td>
                            <?php if (!empty($row['profile_icon'])) { ?>
                                <img src="<?php echo $row['profile_icon']; ?>" alt="Profile Icon" style="width: 50px; height: 50px; border-radius: 50%;">
                            <?php } else { ?>
                                <span>No Icon</span>
                            <?php } ?>
                        </td>

                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script/profiletbl.js"></script>


</body>
</html>
