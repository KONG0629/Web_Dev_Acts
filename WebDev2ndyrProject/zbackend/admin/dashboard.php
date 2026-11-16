<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="style/dashboards.css">
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


<!-- Main Content (Dashboard) -->
<div class="content" id="content">

    <!-- Header -->
    <div class="header">
        <h1>Admin Dashboard</h1>
    </div>

    <!-- Dashboard Overview -->
    <div class="container">


        <div class="row">
            <!-- Total Users Widget -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-users"></i> Total Users</h5>
                        <p class="card-text">
                            <?php
                            include "dbconn.php";
                            $sql = "SELECT COUNT(id) AS total_users FROM `userstbl`";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['total_users'];
                            ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Dashboard Overview Widget -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-tachometer-alt"></i> Dashboard Overview</h5>
                        <p class="card-text">Everything is running smoothly. No errors detected.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Health & Activity Logs Section -->
        <div class="row">
            <!-- System Health -->
            <div class="col-lg-6 mb-4">
                <div class="card text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-heartbeat"></i> System Health</h5>
                        <p class="card-text">All systems are operational with no issues reported.</p>
                    </div>
                </div>
            </div>

            <!-- Activity Logs -->
            <div class="col-lg-6 mb-4">
                <div class="card text-white bg-dark">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa-solid fa-list-alt"></i> Activity Logs</h5>
                        <p class="card-text">Last logged activity: User login at 2:45 PM.</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="boxes">
            <!-- Social Media Section -->
            <div class="row social-media-section">

                <!-- Facebook Box -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-white bg-info">
                    <a href="https://www.facebook.com/profile.php?id=61569272050354&mibextid=ZbWKwL">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-brands fa-facebook"></i> Facebook</h5>
                            <p class="card-text">Follow us on Facebook for the latest updates.</p>
                        </div>
                        </a>
                    </div>
                </div>
                

                <!-- Instagram Box -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-white bg-dark">
                    <a href="https://www.instagram.com/cadenceonebyte/profilecard/?igsh=MWcyaGR1YWs5cTVlZA%3D%3D">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-brands fa-instagram"></i> Instagram</h5>
                            <p class="card-text">Follow us on Instagram for more updates.</p>
                        </div>
                        </a>
                    </div>
                </div>
                

                <!-- Twitter Box -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-white bg-primary">
                    <a href="https://x.com/i/flow/login?redirect_after_login=%2FOneByteCadence">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-brands fa-twitter"></i> Twitter</h5>
                            <p class="card-text">Follow us on Twitter for the latest news.</p>
                        </div>
                        </a>
                    </div>
                </div>
                

                <!-- Gmail Box -->
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card text-white bg-secondary">
                    <a href="onebytecadence@gmail.com">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fa-brands fa-google"></i> Gmail</h5>
                            <p class="card-text">Check your Gmail for recent notifications.</p>
                        </div>
                        </a>
                    </div>
                </div>
                

            </div>

        </div>

    </div>

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="script/admin.js"></script>

</body>
</html>
