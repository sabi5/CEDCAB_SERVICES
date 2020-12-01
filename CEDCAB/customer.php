<?php
    session_start();
    require "Dbconnection.php";
    require "User.php";

    $Connection = new Dbconnection();
    $location = new User();  
    $locate = $location->totalSpent($Connection->con);
    $countRide = $location->totalRides($Connection->con);
    $pendingRide = $location->pendingRides($Connection->con);
   
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
        <title>Customer Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link href="style.css" type="text/css" rel="stylesheet"> -->
        <link href="admin/sidebar.css" type="text/css" rel="stylesheet">
        <!-- edit start -->
        <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="../assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
        <!-- edit end -->

    </head>
    <body>
        <div class="wrapper">
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
                <a href="changePassword.php">Change password </a>
                <a href="invoice.php">Invoice</a> 
                <a href="logout.php">Logout</a>  
            </div>
        </div>
    
        <div class="grid-container">
            <div class="item1">
                <?php $name = $_SESSION['user']['username'];?>
                    <h1 style = 'background-color: pink;text-align :center;'>
                        Welcome to the Dashboard Panel, ' <?php echo $name;?> ' !!</h1>
            </div>
            <div class="item2 tile" id="item2">
                <div class="tile1">
                    <i class="fa fa-money" aria-hidden="true"></i>
                    <a href="allRide.php" class="anchor">Total Spent on Cabs</a> 
                    <?php 
                         
                         $display = 0; 
                        
                         foreach ($locate as $value){
                             $display += $value['total_fare']; 
                         }
                         echo $display;
                    
                    ?>        
                </div>
            </div>
            <div class="item3 tile" id="item3">
                <div class="tile1">
                    <i class="fa fa-car" aria-hidden="true"></i>
                    <a href="allRide.php" class="anchor">Total Rides</a> 
                    <?php echo "</br>".$countRide;?>
                </div>
                
            </div>  
            <div class="item4 tile" id="item4">
                <div class="tile1">
                    <i class="fa fa-car" aria-hidden="true"></i>
                    <a href="pendingRides.php" class="anchor">Pending Rides</a>
                    <?php echo "</br>". $pendingRide;?>
                </div>
            </div>
            <div class="item5 tile" id="item5">
                <div class="tile1">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    <a href="customerProfile.php" class="anchor">View Profile</a>
                </div>
            </div>
        </div>
    </body>
</html>