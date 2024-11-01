<?php
include "navbar.php";
include "connection.php";
session_start(); // Start session if not already started
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style type="text/css">
        .form-control {
            width: 250px;
            height: 38px;
        }
        .form1 {
            margin: 0 auto;
            max-width: 600px;
        }
        label {
            color: white;
        }
        body {
            background-color: #004528;
            color: #fff;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">Edit Information</h2>

<?php
// Fetch user data
$sql = "SELECT * FROM admin WHERE username='" . mysqli_real_escape_string($db, $_SESSION['login_user']) . "'";
$result = mysqli_query($db, $sql) or die(mysqli_error($db));

if ($row = mysqli_fetch_assoc($result)) {
    $first = htmlspecialchars($row['first']);
    $last = htmlspecialchars($row['last']);
    $username = htmlspecialchars($row['username']);
    $password = htmlspecialchars($row['password']);
    $email = htmlspecialchars($row['email']);
    $contact = htmlspecialchars($row['contact']);
}
?>

<div class="profile_info" style="text-align: center;">
    <span>Welcome,</span>    
    <h4><?php echo htmlspecialchars($_SESSION['login_user']); ?></h4>
</div><br><br>

<div class="form1">
    <form action="" method="post" enctype="multipart/form-data">
        <input class="form-control" type="file" name="file">

        <label><h4><b>First Name:</b></h4></label>
        <input class="form-control" type="text" name="first" value="<?php echo $first; ?>" required>

        <label><h4><b>Last Name:</b></h4></label>
        <input class="form-control" type="text" name="last" value="<?php echo $last; ?>" required>

        <label><h4><b>Username:</b></h4></label>
        <input class="form-control" type="text" name="username" value="<?php echo $username; ?>" required>

        <label><h4><b>Password:</b></h4></label>
        <input class="form-control" type="password" name="password" value="<?php echo $password; ?>" required>

        <label><h4><b>Email:</b></h4></label>
        <input class="form-control" type="email" name="email" value="<?php echo $email; ?>" required>

        <label><h4><b>Contact No:</b></h4></label>
        <input class="form-control" type="text" name="contact" value="<?php echo $contact; ?>" required>

        <br>
        <div style="text-align: center;">
            <button class="btn btn-default" type="submit" name="submit">Save</button>
        </div>
    </form>
</div>

<?php 
if (isset($_POST['submit'])) {
    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "images/";
        $pic = basename($_FILES['file']['name']);
        $targetFilePath = $targetDir . $pic;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
            // Successfully uploaded file
        } else {
            $pic = ''; // Reset pic if upload fails
        }
    }

    // Sanitize user input
    $first = mysqli_real_escape_string($db, $_POST['first']);
    $last = mysqli_real_escape_string($db, $_POST['last']);
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $contact = mysqli_real_escape_string($db, $_POST['contact']);

    // Update user information
    $sql1 = "UPDATE admin SET 
                pic='$pic', 
                first='$first', 
                last='$last', 
                username='$username', 
                password='$password', 
                email='$email', 
                contact='$contact' 
                WHERE username='" . mysqli_real_escape_string($db, $_SESSION['login_user']) . "';";

    if (mysqli_query($db, $sql1)) {
        echo "<script type='text/javascript'>
                alert('Saved Successfully.');
                window.location='profile.php';
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error saving data: " . mysqli_error($db) . "');
              </script>";
    }
}
?>
</body>
</html>
