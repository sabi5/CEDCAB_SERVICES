<?php

session_start();
require "Dbconnection.php";
require "User.php";

$Connection = new Dbconnection();
$location = new User();  
$locate = $location->customerProfile($Connection->con);

if (!isset($_SESSION['user']['username'])) {     
    echo '<script>alert("You are logged out")</script>';
   ?>
   <script>location.replace("login.php")</script> 
    <?php
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User Profile page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="admin/sidebar.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="navbar">
            <a href="customer.php">Dashboard</a>
            <div class="dropdown">
                <button class="dropbtn">My Profile</button>
                <div class="dropdown-content">
                    <a href="customerProfile.php">View profile</a>
                    <a href="manageCustomer.php">Manage profile</a>
                </div>
            </div> 
            <div class="dropdown">
                <button class="dropbtn">Rides</button>
                <div class="dropdown-content">
                    <a href="pendingRides.php">Pending Rides</a>
                    <a href="completeRide.php">Completed Rides</a>
                    <a href="allRide.php">All Rides</a>
                </div>
            </div>
            <a href="bookRide.php">Book new ride </a>
            <a href="invoice.php">Invoice</a> 
            <a href="logout.php">Logout</a>  
        </div>
  
        <?php
    
        $name = $_SESSION['user']['username'];
        echo "<h1 style = 'background-color: pink;text-align :center;'>
         Welcome ,'".$name."'!!</h1>";?>
        <h1 style="text-align: center;">Previous Rides</h1>
        <table >
            <tr>
                <th>Id</th>
                <th>username</th>
                <th>email</th>
                <th>Dateofsignup</th>
                <th>mobile</th>
                <th>isblock</th>
                <th>password</th>
                <th>is_admin</th>
            </tr>
            
                <?php
                    
                    foreach($locate as $value){
                    ?>
                        
                        <tr>
                        <td><?php echo $value['user_id']; ?></td>
                            <td><?php echo $value['username']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo $value['dateofsignup']; ?></td>
                            <td><?php echo $value['mobile']; ?></td>
                            <td><?php if($value['isblock'] == 1) { echo "Unblock";} else{ echo "BLOCK";} ?></td>
                            <td><?php echo $value['password']; ?></td>
                            <td><?php echo $value['is_admin']; ?></td>
                            
                        </tr>
                    <?php
                    }?>
        </table>
    </body>
</html>