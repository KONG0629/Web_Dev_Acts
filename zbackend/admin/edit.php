<?php
include "dbconn.php";
$id = isset($_GET['id']) ? $_GET['id'] : null;

$row = [
    'email' => '',
    'password' => '',
    'created_at' => '',
];

if ($id) {
    $sql = "SELECT * FROM `userstbl` WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $created_at = $_POST['created_at'];

    $sql = "UPDATE `userstbl` SET 
        `email`='$email', 
        `password`='$password', 
        `created_at`='$created_at' 
        WHERE id=$id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: index.php?msg=Data updated successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/addnew.css">
</head>
<body>





<div class="nav_sidebar" id="sidebar" style="background-color:#1a2130">
<span class="toggle-btn p-2 fs-2" onclick="toggleSidebar()">&#9776;</span>
    <a class="mb-2 mt-5" href="#">Home</a> 
    <a class="mb-2" href="#">About</a>
    <a class="mb-2" href="#">Support</a>
    <a class="mb-2" href="#">FAQ</a>
    <a class="mb-2" href="#">Company</a>
    <div class="buttonside">
        <a href="#"><button type="button" class="btn btn-outline-light">Discovery</button></a>
        <a href="#"><button type="button" class="btn btn-light">Create Now</button></a>
    </div>
</div>



    <div class="content" id="content">
        <div class="header text-center mb-5 p-3 text-white" style="background-color:#1a2130"><h1>Edit User Information</h1></div>


        <div class="container">
            <form action="" method="POST" style="width:50vw; min-width:300px; margin: auto;">
                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?= $row['email'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" value="<?= $row['password'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Created At:</label>
                    <input type="datetime-local" class="form-control" name="created_at" value="<?= $row['created_at'] ?>">
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>&nbsp;
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="script/admin.js"></script>
</body>
</html>
