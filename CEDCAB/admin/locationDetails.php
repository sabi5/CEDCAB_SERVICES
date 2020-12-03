<?php
require "../Dbconnection.php";
require "../Location.php";

$Connection = new Dbconnection();
$location = new Location();  
$locate = $location->place($Connection->con);



?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Location Details</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="sidebar.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="navbar">
        <a class="navbar-brand text-warning font-weight-bold" href="#"><span>CED </span><span style="color:chartreuse">CAB</span></a>
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
           
            <a href="../logout.php">Logout</a>  
        </div>
  
        
        <h1 style="text-align: center;">Location Details</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Distance</th>
                <th>Is_available</th>
                <th>Action</th>
                
            </tr>
            
                <?php
                    
                    foreach($locate as $value){
                    ?>
                        
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['distance']; ?></td>
                            <td><?php if($value['is_available'] == 1) { echo "Available";} else{ echo "Unavailable";}?></td>
                            <td><a href="editLocation.php?id=<?php echo $value['id']; ?>" title='Edit' onclick="return confirm('Are you sure?')">EDIT</a></td>
							<td><a href="deleteLocation.php?id=<?php echo $value['id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td>
                        </tr>
                    <?php
                    }?>
        </table>
    </body>
</html>