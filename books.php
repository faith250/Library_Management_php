<?php
include "connection.php"; // Database connection
include "navbar.php"; // Navigation bar
session_start(); // Start session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Books</title>
    <style>
        body {
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
        }
        .sidenav {
            height: 100%;
            margin-top: 50px;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #222;
            overflow-x: hidden;
            padding-top: 60px;
        }
        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }
        .sidenav a:hover {
            color: white;
        }
        #main {
            transition: margin-left .5s;
            padding: 16px;
        }
    </style>
</head>
<body>

<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div style="color: white; margin-left: 60px; font-size: 20px;">
        <?php
        if (isset($_SESSION['login_user'])) {
            echo "Welcome " . htmlspecialchars($_SESSION['login_user']);
        }
        ?>
    </div>
    <br>
    <div><a href="add.php">Add Books</a></div>
    <div><a href="request.php">Book Request</a></div>
    <div><a href="issue_info.php">Issue Information</a></div>
    <div><a href="expired.php">Expired List</a></div>
</div>

<div id="main">
    <h2>List Of Books</h2>
    <div class="container">
        <form class="form-inline" method="post">
            <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search books..." required>
            <button class="btn btn-primary my-2 my-sm-0" type="submit" name="submit">Search</button>
        </form>
        <form class="form-inline" method="post">
            <input class="form-control mr-sm-2" type="text" name="bid" placeholder="Enter Book ID" required>
            <button class="btn btn-danger my-2 my-sm-0" type="submit" name="submit1">Delete</button>
        </form>
    </div>

    <?php
    // Search functionality
    if (isset($_POST['submit'])) {
        $search = $db->real_escape_string($_POST['search']);
        $q = mysqli_query($db, "SELECT * FROM books WHERE name LIKE '%$search%'");

        if (mysqli_num_rows($q) == 0) {
            echo "<div class='alert alert-warning'>Sorry! No book found. Try searching again.</div>";
        } else {
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr><th>ID</th><th>Book Name</th><th>Authors Name</th><th>Edition</th><th>Status</th><th>Quantity</th><th>Department</th></tr>";
            while ($row = mysqli_fetch_assoc($q)) {
                echo "<tr>";
                echo "<td>{$row['bid']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['authors']}</td>";
                echo "<td>{$row['edition']}</td>";
                echo "<td>{$row['status']}</td>";
                echo "<td>{$row['quantity']}</td>";
                echo "<td>{$row['department']}</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    } else {
        // Display all books if no search is performed
        $res = mysqli_query($db, "SELECT * FROM books ORDER BY name ASC");
        echo "<table class='table table-bordered table-hover'>";
        echo "<tr><th>ID</th><th>Book Name</th><th>Authors Name</th><th>Edition</th><th>Status</th><th>Quantity</th><th>Department</th></tr>";
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>";
            echo "<td>{$row['bid']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['authors']}</td>";
            echo "<td>{$row['edition']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>{$row['quantity']}</td>";
            echo "<td>{$row['department']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    // Delete functionality
    if (isset($_POST['submit1'])) {
        if (isset($_SESSION['login_user'])) {
            $bid = $db->real_escape_string($_POST['bid']);
            if (mysqli_query($db, "DELETE FROM books WHERE bid = '$bid'")) {
                echo "<script>alert('Delete Successful.');</script>";
            } else {
                echo "<script>alert('Delete Failed.');</script>";
            }
        } else {
            echo "<script>alert('Please Login First.');</script>";
        }
    }
    ?>
</div>
</body>
</html>
