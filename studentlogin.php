<?php
include "connection.php";
include "navbar.php";
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        section { margin-top: -20px; }
    </style>
</head>
<body>
<section>
    <div class="log_img">
        <br>
        <div class="box1">
            <h1 style="text-align: center; font-size: 35px;font-family: Lucida Console;">Library Management System</h1>
            <h1 style="text-align: center; font-size: 25px;">User Login Form</h1><br>
            <form name="login" action="" method="post">
                <div class="login">
                    <input class="form-control" type="text" name="username" placeholder="Username" required=""> <br>
                    <input class="form-control" type="password" name="password" placeholder="Password" required=""> <br>
                    <input class="btn btn-default" type="submit" name="submit" value="Login" style="color: black; width: 70px; height: 30px">
                </div>
            </form>
            <?php
            if (isset($_POST['submit'])) {
                $username = mysqli_real_escape_string($db, $_POST['username']);
                $password = mysqli_real_escape_string($db, $_POST['password']);
                $res = mysqli_query($db, "SELECT * FROM `student` WHERE username='$username' AND password='$password'");

                if (!$res) {
                    echo "<div class='alert alert-danger'>Query error: " . mysqli_error($db) . "</div>";
                } else {
                    $count = mysqli_num_rows($res);
                    if ($count == 0) {
                        echo "<div class='alert alert-danger' style='width: 600px; margin-left: 370px; background-color: #de1313; color: white'>The username and password don't match</div>";
                    } else {
                        $_SESSION['login_user'] = $username;
                        echo "<script type='text/javascript'>window.location='index.php';</script>";
                    }
                }
            }
            ?>
        </div>
    </div>
</section>
</body>
</html>
