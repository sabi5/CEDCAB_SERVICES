<?php
session_start();
require "Dbconnection.php";
// require "User.php";

$Connection = new Dbconnection();
$conn = $Connection->con;

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    // $password = $_POST['password'];
    // $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $insert = " UPDATE tbl_user SET `username` = '$username', 
               `mobile`='$mobile' WHERE  `user_id` = '$id' ";
    
    $uquery = mysqli_query($conn, $insert);
    
    if ($uquery) {
        echo '<script> alert("Updated successfully")</script>';
        ?>
        <script>location.replace("customer.php")</script>
        <?php
    }
}

$id = $_GET['id'];

$query = "SELECT *FROM `tbl_user` WHERE `user_id`='$id'";
$result = mysqli_query($conn, $query)or die($mysqli_error($conn));
$row = mysqli_fetch_assoc($result); 
if ($row) {
    $username= $row['username'];
    // $password= $row['password'];
    // $email= $row['email'];
    $mobile= $row['mobile'];
} else {
        echo '<script> alert("No data found"); </script>';
}
  
?>
<html>
    <head>
        <title>UPDATE User</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    </head>
    <body>
        <div id="wrapper">
            <div class="container form">
                <h2>Update Details</h2><br>
                <form action="edituser.php" method="POST">
                    <p>
                        <label for="username">Username : <input type="text" 
                         name="username" value="<?php  echo $username; ?>" required></label>
                    </p>
                    
                    <p>
                        <label for="number">Mobile no. : <input type="number" name="mobile" 
                        value="<?php  echo $mobile; ?>" required></label>
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
