<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Requests</title>

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
    <div class="header text-center mb-5 p-3 text-white" style="background-color:#1a2130">
        <h1>SUPPORT REQUESTS</h1>
    </div>

    <div class="container">
        <table class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Assistance</th>
                    <th scope="col">Email</th>
                    <th scope="col">Issue</th>
                    <th scope="col">Subject</th>
                    <th scope="col">Details</th>
                    <th scope="col">Attachment</th>
                    <th scope="col">Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../db.php'; // Ensure the db connection file path is correct
                
                $sql = "SELECT id, assistance, email, issue, subject, detail, attachment, created_at FROM supporttbl";
                $result = mysqli_query($conn, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['assistance']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['issue']); ?></td>
                            <td><?php echo htmlspecialchars($row['subject']); ?></td>
                            <td><?php echo htmlspecialchars($row['detail']); ?></td>
                            <td>
                                <?php if (!empty($row['attachment'])): ?>
                                    <a href="<?php echo htmlspecialchars($row['attachment']); ?>" target="_blank">View</a>
                                <?php else: ?>
                                    No File
                                <?php endif; ?>
                            </td>
                            <td><?php echo $row['created_at']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='8'>No support requests found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!--Bootstrap JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script/admin.js"></script>

</body>
</html>
