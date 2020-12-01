<?php
require "../Dbconnection.php";
require "../Admin.php";

$Connection = new Dbconnection();
$location = new Admin();  
$locate = $location->user($Connection->con);


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Manage User</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="sidebar.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="navbar">
            <a href="admin.php">Dashboard</a>
            <div class="dropdown">
                <button class="dropbtn">User</button>
                <div class="dropdown-content">
                    <a href="adduser.php">Add User</a>
                    <a href="manageuser.php">Manage User</a>
                    <a href="pendingUser.php">Pending Users</a>
                    <a href="approvedUser.php">Approved User</a>
                </div>
            </div> 
            <div class="dropdown">
                <button class="dropbtn">Ride</button>
                <div class="dropdown-content">
                    <a href="pendingRide.php">Pending Rides</a>
                    <a href="completeRide.php">Completed Rides</a>
                    <a href="cancelledRide.php">Cancelled Rides</a>
                    <a href="allRide.php">All Rides</a>
                </div>
            </div> 
            <div class="dropdown">
                <button class="dropbtn">Location</button>
                <div class="dropdown-content">
                    <a href="locationDetails.php">Location List</a>
                    <a href="addLocation.php">Add New Location</a>
                </div>
            </div> 
            <a href="#">Invoice</a> 
            <a href="../logout.php">Logout</a>  
        </div>
  
        <h1 style="text-align: center;">Manage User</h1>
        <table>
            <tr>
                <th>User_id</th>
                <th>username</th>
                <th>Email</th>
                <th>dateofsignup</th>
                <th>mobile</th>
                <th>isblock</th>
                <th>password</th>
                <th>Is_admin</th>
                <th>Action</th>
                
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
                            <td><?php if($value['isblock'] == 1) { echo "Unblock";} else{ echo "BLOCK";}?></td>
                            <td><?php echo $value['password']; ?></td>
                            <td><?php echo $value['is_admin']; ?></td>
                            <td><a href="edituserAdmin.php?id=<?php echo $value['user_id']; ?>" title='Edit'>EDIT</a></td>
							<td><a href="deleteuserAdmin.php?id=<?php echo $value['user_id']; ?>" title='Delete'>DELETE</a></td>
                        </tr>
                    <?php
                    }?>
        </table>
    </body>
</html>