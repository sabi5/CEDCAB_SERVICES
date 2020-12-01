<?php

session_start();

require "Dbconnection.php";
require "User.php";

if (isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    // $checked = $_POST['remember_me'];
    $User = new User();
    $Connection = new Dbconnection();

    // if(isset($_POST['remember_me'])){
    //     $checked = $_POST['remember_me'];

    //     echo $checked."hello";
    //     echo "</br>";
    // }
    // else{
    //     echo("not");
    // }
    $sql = $User->login($username, $password, $checked, $Connection->con);
    echo $sql;
}


?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    </head>
    <body>
       <div class="container form">
           <div id="login-form">
                <h2>Login</h2><br>
                <form action="login.php" method="POST">
                    <p>
                        <label for="username">Username : <input type="text" name="username" value = "<?php if(isset($_COOKIE['username'])){ echo $_COOKIE['username'];
                        } ?>" required></label>
                    </p>
                    <p>
                        <label for="password">Password : <input type="password" name="password" value = "<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password'];
                        } ?>" required></label>
                    </p>
                   
                    <p>
                        <input class="btn btn-success" type="submit" name="submit" value="Login">
                    </p>
                    
                </form>
                <a href="signup.php"><button class="btn btn-primary">SIGN UP</button></a> <span> Don't have an account yet?</span>
            </div>
        </div>
    </body>
</html>
