<?php
include "navbar.php";
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div class="logo"><img src="images/9.png" alt="logo">
            <h1 style="color: white;">PANTHEON LIBRARIES</h1>
        
        </div>
        
    </header>
    <section>
        <div class="reg_img">
                   
                    <div class="box2">
                        <br><br><br><br>
                        <h1 style="text-align: center;font-size: 25px;">LIBRARY MANAGEMENT SYSTEM</h1><br>
                        <h1 style="text-align: center;font-size: 25px;">User Registration Form</h1><br>
                        <form  name="Registration" action="" method="post">
                            
                            <div class="login">
                            <input type="text" name="first" placeholder="First name"><br><br>
                            <input type="text" name="last" placeholder="Last name"><br><br>
                            <input type="text" name="username" placeholder="Username" required=""><br><br>
                            <input type="password" name="password" placeholder="Password" required=""><br><br>
                            <input type="text" name="roll" placeholder="Roll No" required=""><br><br>
                            <input type="email" name="email" placeholder="Email" required=""><br><br>
                            <input type="text" name="contact" placeholder="Phone no" required=""><br><br>
                            <input type="submit" name="submit" value="sign up" >
                            </div>
                        </form>
                        
        
                    </div>

        </div>
    </section>
    <?php
    if(isset($_POST['submit']))
    {
        $count=0;
        $sql="SELECT username from student";
        $res=mysqli_query($db,$sql);
        while($row=mysqli_fetch_assoc($res))
        {
            if($row['username']==$_POST['username'])
            {
                $count=$count+1;
            }
        }
        if($count==0)
        {
        mysqli_query($db,"INSERT INTO `student` values('$_POST[first]', '$_POST[last]', '$_POST[username]', '$_POST[password]', '$_POST[roll]', '$_POST[email]', '$_POST[contact]');");
    ?>
    <script type="text/javascript">
        alert("Registration Successful");
        </script>
        <?php
        }
        else{
            ?>
    <script type="text/javascript">
        alert("The user name is already taken");
        </script>
        <?php

        }
    }
    
    ?>
</body>
</html>