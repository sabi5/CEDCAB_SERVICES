<?php
 
session_start();

require "../Dbconnection.php";
require "../User.php";

if (isset($_POST['submit'])) {
    $username =  $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['password2'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $User = new User();
    $Connection = new Dbconnection();

    $sql = $User->signup($username, $password, $repassword, $email, $mobile, $Connection->con);
    echo $sql;

}
if (!isset($_SESSION['user']['username'])) {     
    echo '<script>alert("You are logged out")</script>';
   ?>
   <script>location.replace("../login.php")</script> 
    <?php
}
?>

<html>
    <head>
        <title>Add User</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        
    </head>
    <body>
        <div id="wrapper">
            <div class="container form">
                <h2>Sign Up</h2><br>
                <form action="adduser.php" method="POST">
                    <p>
                        <label for="username">Username : <input type="text" 
                         name="username" required></label>
                    </p>
                    <p>
                        <label for="password">Password : <input type="password" 
                        name="password" required></label>
                    </p>
                    <p>
                        <label for="password2">Re-Password : <input type="password" 
                        name="password2" required></label>
                    </p>
                    <p>
                        <label for="email">Email : <input type="email" name="email" 
                        required></label>
                    </p>
                    <p>
                        <label for="number">Mobile no. : <input type="number" name="mobile" 
                        required></label>
                    </p> 
                  
                    <p>
                        <input class="btn btn-success" type="submit" name="submit" value="Submit">
                    </p>
                    
                </form>
                <a href="admin.php"><button class="btn btn-warning">DASHBOARD</button> </a>
                <a href="login.php"><button class="btn btn-primary">LOGIN</button> </a>
            </div>
        </div>
    </body>
</html>
