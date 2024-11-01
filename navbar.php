<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <title>Online Library Management System</title>
</head>
<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand active">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="index.php">HOME</a></li>
                <li><a href="books.php">BOOKS</a></li>
                <li><a href="feedback.php">FEEDBACK</a></li>
            </ul>
            <?php if (isset($_SESSION['login_user'])) { ?>
                <ul class="nav navbar-nav">
                    <li><a href="profile.php">PROFILE</a></li>
                    <li><a href="student.php">STUDENT-INFORMATION</a></li>
                    <li><a href="fine.php">FINES</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="profile.php">
                        <div style="color: white">
                            <?php
                            // Ensure 'pic' is set before accessing it
                            $profilePic = isset($_SESSION['pic']) ? $_SESSION['pic'] : 'default-profile.jpg'; // Set a default image if not set
                            echo "<img class='img-circle profile_img' height='30' width='30' src='images/{$profilePic}'>";
                            echo " " . htmlspecialchars($_SESSION['login_user']); // Use htmlspecialchars for security
                            ?>
                        </div>
                    </a></li>
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
                </ul>
            <?php } else { ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="admin_login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
                    <li><a href="registration.php"><span class="glyphicon glyphicon-user"> SIGN UP</span></a></li>
                </ul>
            <?php } ?>
        </div>
    </nav>

</body>
</html>
