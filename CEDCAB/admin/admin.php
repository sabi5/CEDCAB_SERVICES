<?php

    session_start();
    require "../Dbconnection.php";
    require "../Location.php";
    require "../Admin.php";

    $Connection = new Dbconnection();
    $location = new Location();  
    $admin = new Admin();

    $locate = $location->place($Connection->con);
    $totalRides = $admin->totalRides($Connection->con);
    $totalEarn = $admin->totalEarn($Connection->con);
    $pendingRides = $admin->pendingRides($Connection->con);
    $pendingUsers = $admin->pendingUsers($Connection->con);

    $pendingLast = $admin->pendingLast($Connection->con);

    if (!isset($_SESSION['user']['username'])) {     
        echo '<script>alert("You are logged out")</script>';
    ?>
    <script>location.replace("../login.php")</script> 
        <?php
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Admin page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      
        <link rel="stylesheet" href="sidebar.css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="sidebar.css">
    </head>
    <body>
        <div class="navbar">
        <a class="navbar-brand text-warning font-weight-bold" href="#"><span>CED </span><span style="color:chartreuse">CAB</span></a>
            <a href="admin.php">Dashboard</a>
            
            <a href="changeadminPassword.php">Change password </a>
            
            <a href="../logout.php">Logout</a>  
        </div>
        <div class="grid-container">
            <div class="item1">
                <?php $name = $_SESSION['user']['username'];?>
                <h1 style = 'background-color: pink;text-align :center;'>
                    Welcome to the Admin Panel, ' <?php echo $name;?> ' !!</h1>

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
                </tr> 
                    <?php
                    foreach($pendingLast as $value){
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
                        <td style ="background-color: red;"><?php if($value['status'] == 1) { echo "Pending";} elseif($value['status'] == 2){ echo "Completed";} else{ echo "Cancelled";}  ?></td>
                        <td><?php echo $value['customer_user_id']; ?></td>
                            
                    <?php
                    } ?>
               </table>
            </div>
            <div class="item2">
                <div class="main">
                    <aside>
                        <div class="sidebar left ">
                            <div class="user-panel">
                                <div class="pull-left image">
                                    <img src="http://via.placeholder.com/160x160" class="rounded-circle" alt="User Image">
                                </div>
                                <div class="pull-left info">
                                    <p>CEDCAB</p>
                                    
                                </div>
                            </div>
                            <ul class="list-sidebar bg-defoult">
                                <li> 
                                <a href="admin.php"><i class="fa fa-diamond"></i> <span class="nav-label">Dashboard</span></a> 
                                <li> <a href="#" data-toggle="collapse" data-target="#dashboard" class="collapsed active" > <i class="fa fa-th-large"></i> <span class="nav-label"> User </span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu collapse" id="dashboard">
                                        <li class="active"><a href="adduser.php">Add User</a></li>
                                        <li><a href="manageuser.php">Manage User</a></li>
                                        <li><a href="pendingUser.php">Pending User</a></li>
                                        <li><a href="approvedUser.php">Approved User</a></li>
                                    </ul>
                                </li>
                                
                                <li> <a href="#" data-toggle="collapse" data-target="#products" class="collapsed active" > <i class="fa fa-bar-chart-o"></i> <span class="nav-label">Ride</span> <span class="fa fa-chevron-left pull-right"></span> </a>
                                    <ul class="sub-menu collapse" id="products">
                                        <li><a href="pendingRide.php">Pending Rides</a></li>
                                        <li><a href="completeRide.php">Completed Rides</a></li>
                                        <li><a href="cancelledRide.php">Cancelled Rides</a></li>
                                        <li><a href="allRide.php">All Rides</a></li>
                                    </ul>
                                </li>
                                
                                <li> <a href="#" data-toggle="collapse" data-target="#tables" class="collapsed active" ><i class="fa fa-table"></i> <span class="nav-label">Location</span><span class="fa fa-chevron-left pull-right"></span></a>
                                <ul  class="sub-menu collapse" id="tables" >
                                    <li><a href="locationDetails.php">Location List</a></li>
                                    <li><a href="addLocation.php">Add New Location</a></li>
                                    
                                </ul>
                                </li>

                                <li> <a href="../logout.php"><i class="fa fa-files-o"></i> <span class="nav-label">Logout</span></a></li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
            
            <div class="item3 tile" id="item3">
                <div class="tile1">
                <a href="allRide.php" class="anchor">Total Earnings</a> 
                <?php 
                    $display = 0; 
                        
                    foreach ($totalEarn as $value){
                        $display += $value['total_fare']; 
                    }
                    echo " Rs.".$display."/-";
                ?>
            
                </div>
                
            </div>  
            <div class="item4 tile" id="item4">
                <div class="tile1 text-center">
                <a href="pendingRide.php" class="anchor">Pending Rides</a>
                <?php echo "</br>".$pendingRides;?>
                </div>
                
            </div>
            <div class="item5 tile" id="item5">
                <div class="tile1">
                    <a href="pendingUser.php" class="anchor">Pending User request</a>
                    <?php echo "</br>".$pendingUsers;?>
                    
                </div>
                
            </div>
            <div class="item6 tile" id="item2">
                <div class="tile1">
                <a href="allRide.php" class="anchor">Total Rides</a> 
                <?php echo "</br>".$totalRides;?>
                </div>
            </div>  
        </div>
    </body>
</html>

