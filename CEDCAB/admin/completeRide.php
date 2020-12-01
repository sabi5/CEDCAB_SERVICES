<?php
require "../Dbconnection.php";

require "../Admin.php";
require "../Ride.php";

$Connection = new Dbconnection();

$ride = new Ride();  
$location = new Admin();  
$locate = $location->completeRide($Connection->con);

if (!isset($_SESSION['user']['username'])) {     
    echo '<script>alert("You are logged out")</script>';
   ?>
   <script>location.replace("../login.php")</script> 
    <?php
}
?>
?>

<!-- *********************  filter -->
<?php
    if(isset($_POST['filter'])){
        if(!empty($_POST['select'])){
            $selected = $_POST['select'];
            echo $selected;
            echo "</br>";
            $filter = $ride->filterAdmin($selected, $Connection->con);
        }
        else{
        echo("not ");
        }
    }

    if(isset($_POST['sort'])){
        if(!empty($_POST['select'])){
            $sort = $_POST['select'];
            echo $sort;
            echo "</br>";
            $sorted = $ride->sortAdmin($sort, $Connection->con);
            $fare = $ride->fareAdmin($sort, $Connection->con);
            $cabtype = $ride->cabtypeAdmin($sort, $Connection->con);

        }
        else{
        echo("not ");
        }
    }
        
?>
<!-- ********************************************* -->


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Completed Rides</title>
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
            
            <a href="../logout.php">Logout</a>  
        </div>
  
        
        <h1 style="text-align: center;">Completed Rides</h1>
        <!-- *********************** filter and sort-->

        <form action="completeRide.php" method="post">
            <input type="submit" name="filter" value="FILTER">
                <select name="select">
                    <option value="" disabled selected>Choose an option</option>
                    <option value="last 7 days">last 7 days</option>
                    <option value="last 30 days">last 30 days</option>
                </select>
        </form>
<br>
        <form action="completeRide.php" method="post">
            <input type="submit" name="filter" value="FILTER(CABTYPE)">
                <select name="select">
                    <option value="" disabled selected>Choose an option</option>
                    <option value="CedMicro">CedMicro</option>
                    <option value="CedMini">CedMini</option>
                    <option value="CedRoyal">CedRoyal</option>
                    <option value="CedSUV">CedSUV</option>
                </select>
        </form>
<br>
        <form action="completeRide.php" method="post">
            <input type="submit" name="sort" value="SORT BY">
                <select name="select">
                    <option value="" disabled selected>Choose an option</option>
                    <option value="ascending">Ascending(RIDE_DATE)</option>
                    <option value="descending">Descending(RIDE_DATE)</option>
                    <option value="asc">Ascending(FARE)</option>
                    <option value="desc">Descending(FARE)</option>
                    <option value="cab asc">Ascending(CABTYPE)</option>
                    <option value="cab desc">Descending(CABTYPE)</option>
                </select>
        </form>
<br><br>
        <!-- *********************************************** end filter -->

        <table>
            <tr>
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
                <th>Action</th>             
                
            </tr>
            
                <?php
                    if(isset($_POST['filter']) && $selected == "last 30 days"){
                        foreach($filter as $value){
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
                                <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                                <td><?php echo $value['customer_user_id']; ?></td>
							    <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                            </tr>
                        <?php
                        }
                    }elseif(isset($_POST['filter']) && $selected == "last 7 days"){
                        foreach($filter as $value){
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
                                    <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                                    <td><?php echo $value['customer_user_id']; ?></td>
                                    
							        <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                                </tr>
                            <?php
                            }
                    }elseif(isset($_POST['filter']) && $selected == "CedMicro"){
                        foreach($filter as $value){
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
                                    <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                                    <td><?php echo $value['customer_user_id']; ?></td>
                                    
							        <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                                </tr>
                            <?php
                            }
                    }elseif(isset($_POST['filter']) && $selected == "CedMini"){
                        foreach($filter as $value){
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
                                    <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                                    <td><?php echo $value['customer_user_id']; ?></td>
                                    
							        <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                                </tr>
                            <?php
                            }
                    }elseif(isset($_POST['filter']) && $selected == "CedRoyal"){
                        foreach($filter as $value){
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
                                    <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                                    <td><?php echo $value['customer_user_id']; ?></td>
                                    
							        <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                                </tr>
                            <?php
                            }
                    }elseif(isset($_POST['filter']) && $selected == "CedSUV"){
                        foreach($filter as $value){
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
                                    <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                                    <td><?php echo $value['customer_user_id']; ?></td>
                                   
							        <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                                </tr>
                            <?php
                            }
                    }
                    
                    elseif(isset($_POST['sort']) && $sort == "ascending"){
                        foreach($sorted as $value){
                            
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
                                <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                                <td><?php echo $value['customer_user_id']; ?></td>
                               
							    <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                            </tr>
                        <?php
                        }
                    }elseif(isset($_POST['sort']) && $sort == "descending"){
                        foreach($sorted as $value){
                           
                            
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
                                <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                                <td><?php echo $value['customer_user_id']; ?></td>
                                
							    <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                            </tr>
                        <?php
                        }
                    }elseif(isset($_POST['sort']) && $sort == "asc"){
                        foreach($fare as $value){
                           
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
                                <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                                <td><?php echo $value['customer_user_id']; ?></td>
                               
							    <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                            </tr>
                        <?php
                        }
                    }elseif(isset($_POST['sort']) && $sort == "desc"){
                        foreach($fare as $value){
                            
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
                                <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                                <td><?php echo $value['customer_user_id']; ?></td>
                               
							    <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                            </tr>
                        <?php
                        }
                    }elseif(isset($_POST['sort']) && $sort == "cab asc"){
                        foreach($cabtype as $value){
                            
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
                                <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                                <td><?php echo $value['customer_user_id']; ?></td>
                               
							    <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                            </tr>
                        <?php
                        }
                    }elseif(isset($_POST['sort']) && $sort == "cab desc"){
                        foreach($cabtype as $value){
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
                                <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                                <td><?php echo $value['customer_user_id']; ?></td>
                                
							    <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                            </tr>
                        <?php
                        }
                    }
                    
                    else{
                    
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
                            <td><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                            <td><?php echo $value['customer_user_id']; ?></td>
                            
							<td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td>
                        </tr>
                    <?php
                   } }?>
        </table>
    </body>
</html>