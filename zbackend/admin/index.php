<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>

    <!--Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--Fontawesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="style/sidebar.css">

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

        <div class="header text-center mb-5 p-3 text-white" style="background-color:#1a2130"><h1>ACCOUNT PAGE</h1></div>

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

            <a href="addnew.php" class="btn btn-dark mb-4">Add New</a>

            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include "dbconn.php";
                    $sql = "SELECT `id`, `email`, `password`, `created_at` FROM `userstbl`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td> <?php echo $row['id'] ?></td>
                            <td> <?php echo $row['email'] ?></td>
                            <td> <?php echo $row['password'] ?></td>
                            <td> <?php echo $row['created_at'] ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id'] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
                                <a href="delete.php?id=<?php echo $row['id'] ?>" class="link-dark"><i class="fa-solid fa-trash fs-5"></i></a>
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

    <script src="script/admin.js"></script>


</body>
</html>
