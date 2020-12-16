<?php
require "../Dbconnection.php";
// require "../User.php";
require "../Admin.php";
require "../Ride.php";

$Connection = new Dbconnection();
// $location = new User();
$ride = new Ride();    
$location = new Admin();  
$locate = $location->pendingRide($Connection->con);

// if(($_SESSION['user']['is_admin'] != 1)){
//     echo '<script>alert("You are unauthorised person")</script>';
//     ?>
<!-- // <script>location.replace("../customer.php")</script>  -->
    <?php
// }

?>

<!-- *********************  filter -->
<?php
    if(isset($_POST['filter'])){
        if(!empty($_POST['select'])){
            $selected = $_POST['select'];
            // echo $selected;
            // echo "</br>";
            $filter = $ride->filterpendingAdmin($selected, $Connection->con);
        }
        else{
        echo("not ");
        }
    }

    if(isset($_POST['sort'])){
        if(!empty($_POST['select'])){
            $sort = $_POST['select'];
            // echo $sort;
            // echo "</br>";
            $sorted = $ride->sortpendingAdmin($sort, $Connection->con);
            $fare = $ride->farependingAdmin($sort, $Connection->con);
            $cabtype = $ride->cabtypependingAdmin($sort, $Connection->con);

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
        <title>Pending Ride</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
            <!-- <a href="invoice.php">Invoice</a>   -->
            <a href="../logout.php">Logout</a>  
        </div>
  
        
        <h1 style="text-align: center;"><marquee>Pending Rides</marquee></h1>

         <!-- *********************** filter and sort-->

         <form action="pendingRide.php" method="post">
            <select name="select" required>
                <option value="" disabled selected>Choose an option</option>
                <option value="last 7 days">last 7 days</option>
                <option value="last 30 days">last 30 days</option>
            </select>
            <input type="submit" name="filter" value="FILTER" class="filter">
        </form>
        <br>
        <form action="pendingRide.php" method="post">
            <select name="select" required>
                <option value="" disabled selected>Choose an option</option>
                <option value="CedMicro">CedMicro</option>
                <option value="CedMini">CedMini</option>
                <option value="CedRoyal">CedRoyal</option>
                <option value="CedSUV">CedSUV</option>
            </select>
            <input type="submit" name="filter" value="FILTER(CABTYPE)" class="filter">
        </form>
        <br>
        <form action="pendingRide.php" method="post">
            <select name="select" required>
                <option value="" disabled selected>Choose an option</option>
                <option value="ascending">Ascending(RIDE_DATE)</option>
                <option value="descending">Descending(RIDE_DATE)</option>
                <option value="asc">Ascending(FARE)</option>
                <option value="desc">Descending(FARE)</option>
                <option value="cab asc">Ascending(CABTYPE)</option>
                <option value="cab desc">Descending(CABTYPE)</option>
            </select>
            <input type="submit" name="sort" value="SORT BY" class="filter">
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
                <th>Distance (in km)</th>
                <th>Luggage (in kg)</th>
                <th>Total_fare (in Rs.)</th>
                <th>Status</th>
                <th>User_id</th>     
                <th>Action</th>     
                <th>Invoice</th>         
                
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
                                <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-edit' style='font-size:24px'></i></a></td>
                                <!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete'>DELETE</a></td> -->
                                <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
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
                                    <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')"><i class='fas fa-edit' style='font-size:24px'></i></a></td>
                                    <!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td> -->
                                    <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
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
                                    <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')"><i class='fas fa-edit' style='font-size:24px'></i></a></td>
                                    <!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td> -->
                                    <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
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
                                    <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')"><i class='fas fa-edit' style='font-size:24px'></i></a></td>
                                    <!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td> -->
                                    <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
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
                                    <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')"><i class='fas fa-edit' style='font-size:24px'></i></a></td>
                                    <!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td> -->
                                    <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
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
                                    <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')"><i class='fas fa-edit' style='font-size:24px'></i></a></td>
                                    <!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td> -->
                                    <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
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
                                <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')"><i class='fas fa-edit' style='font-size:24px'></i></a></td>
                                <!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td> -->
                                <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
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
                                <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')"><i class='fas fa-edit' style='font-size:24px'></i></a></td>
                                <!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td> -->
                                <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
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
                                <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')"><i class='fas fa-edit' style='font-size:24px'></i></a></td>
                                <!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td> -->
                                <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
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
                                <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')"><i class='fas fa-edit' style='font-size:24px'></i></a></td>
                                <!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td> -->
                                <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
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
                                <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')"><i class='fas fa-edit' style='font-size:24px'></i></a></td>
                                <!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td> -->
                                <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
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
                                <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')"><i class='fas fa-edit' style='font-size:24px'></i></a></td>
                                <!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td> -->
                                <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
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
                            <td><a href="editstatus.php?id=<?php echo $value['ride_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')"><i class='fas fa-edit' style='font-size:24px'></i></a></td>
							<!-- <td><a href="deletestatus.php?id=<?php echo $value['ride_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td> -->
                            <td><a href="invoice.php?id=<?php echo $value['ride_id']; ?>" title='Edit'><i class='fas fa-file' style='font-size:24px'></i></a></td>
                        </tr>
                <?php
               } }?>
        </table>
    </body>
</html>