<?php
session_start();
require "Dbconnection.php";
// require "User.php";

$Connection = new Dbconnection();
$conn = $Connection->con;

if (!isset($_SESSION['user']['username'])) {     
    echo '<script>alert("You are logged out")</script>';
   ?>
   <script>location.replace("login.php")</script> 
    <?php
}


if (isset($_POST['submit'])) {
    $ids = $_POST['id'];
    $password = $_POST['password'];
    $repassword = $_POST['password2'];
    // echo $repassword;

    if($password == $repassword){
        echo '<script> alert("")</script>';

    }
    
    $insert = " UPDATE `tbl_user` SET `password` = '$repassword'
                WHERE  `user_id` = '$ids' ";
    // echo $insert;
    
    $uquery = mysqli_query($conn, $insert);
    // echo $uquery;
    
    if ($uquery) {
        echo '<script> alert("Updated successfully")</script>';
        ?>
        <script>location.replace("login.php")</script>
        <?php
    }
}

// $id = $_GET['id'];
$id = $_SESSION['user']['id'];

$query = "SELECT *FROM `tbl_user` WHERE `user_id`='$id'";
$result = mysqli_query($conn, $query)or die($mysqli_error($conn));
$row = mysqli_fetch_assoc($result); 
if ($row) {
    
    $password= $row['password'];
    // echo $password;
   
} else {
        echo '<script> alert("No data found"); </script>';
}
  
?>
<html>
    <head>
        <title>Change password</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    </head>
    <body>
        <div id="wrapper">
            <div class="container form">
                <h2>Change password</h2><br>
                <form action="changePassword.php" method="POST">
                    
                    <p>
                        <label for="password">Old Password : <input type="password" 
                        name="password" value="<?php  echo $password; ?>" required></label>
                    </p>
                    <p>
                        <label for="password2">New Password : <input type="password" 
                        name="password2" required></label>
                    </p>
                    
					<input type="hidden" name="id" value="<?php  echo $id; ?>" 
					style="display:none;">
                    <p>
                        <input class="btn btn-success" type="submit" name="submit" value="Submit">
                    </p>
                    
                </form>
                <a href="login.php"><button class="btn btn-primary">LOGIN</button> </a>
            </div>
        </div>
    </body>
</html>
