<?php

session_start();
require "Dbconnection.php";
require "Ride.php";

$Connection = new Dbconnection();
$location = new Ride();  
$locate = $location->invoice($Connection->con);

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
        <title>Invoice</title>
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
         Welcome ,'".$name."'!! Thanks for using our services...</h1>";?>
        <h1 style="text-align: center;">Invoice</h1>

       

        <div>
            <button style = 'background-color: lightgreen;' onclick="window.print()">Print</button>
        </div>
        <br>
        <table>
            <tr >
                <th>Id</th>
                <th>Date</th>
                <th>Pick</th>
                <th>Drop</th>
                <th>Cabtype</th>
                <th>Distance</th>
                <th>Luggage</th>
                <th>Total_fare</th>
                <th>Status</th>
                <th>User_id</th> 
            </tr>
            
                <?php
                    
                    
                        foreach($locate as $value){
                        ?>
                            
                            <tr>
                                <td><?php echo $value['ride_id']; ?></td>
                                <td><?php echo $value['ride_date']; ?></td>
                                <td><?php echo $value['pick_place']; ?></td>
                                <td><?php echo $value['drop_place']; ?></td>
                                <td><?php echo $value['cab_type']; ?></td>
                                <td><?php echo $value['total_distance']; ?></td>
                                <td><?php echo $value['luggage']; ?></td>
                                <td><?php echo $value['total_fare']; ?></td>
                                <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";} ?></td>
                                <td><?php echo $value['customer_user_id']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
              
        </table>
        </div>
    </body>
</html>