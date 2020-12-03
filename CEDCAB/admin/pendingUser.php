<?php
require "../Dbconnection.php";
require "../Admin.php";
// require "../User.php";

$Connection = new Dbconnection();
$location = new Admin();  
// $location = new User();  
$locate = $location->pendingUser($Connection->con);
// echo $locate;


?>

<!-- *********************  filter -->
<?php
    

    if(isset($_POST['sort'])){
        if(!empty($_POST['select'])){
            $sort = $_POST['select'];
            // echo $sort;
            // echo "</br>";
            $sortDate = $location->sortDate($sort, $Connection->con);
            $sortName = $location->sortName($sort, $Connection->con);

        }
        else{
        echo("not ");
        }
    }
        
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
  
        <h1 style="text-align: center;">Pending Users</h1>

        <!-- *********************** filter and sort-->

        <form action="pendingUser.php" method="post">
            <select name="select" required>
                <option value="" disabled selected>Choose an option</option>
                <option value="ascending">Ascending(DATE)</option>
                <option value="descending">Descending(DATE)</option>
                <option value="asc">Ascending(NAME)</option>
                <option value="desc">Descending(NAME)</option>
                
            </select>
            <input type="submit" name="sort" value="SORT BY" class="filter">
        </form>
        <br><br>
<!-- *********************************************** end filter -->
        <table>
            <tr>
                <th>User_id</th>
                <th>username</th>
                <th>Email</th>
                <th>dateofsignup</th>
                <th>mobile</th>
                <th>status</th>
                <!-- <th>password</th>
                <th>Is_admin</th> -->
                <th>Action</th>
                
            </tr>
            
                <?php

if(isset($_POST['sort']) && $sort == "ascending"){
    foreach($sortDate as $value){
        
    ?>
        <tr>
            <td><?php echo $value['user_id']; ?></td>
            <td><?php echo $value['username']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['dateofsignup']; ?></td>
            <td><?php echo $value['mobile']; ?></td>
            <td><?php if($value['isblock'] == 1) { echo "Unblock";} else{ echo "BLOCK";} ?></td>
            <!-- <td><?php echo $value['password']; ?></td>
            <td><?php echo $value['is_admin']; ?></td> -->
            <td><a href="edituserAdmin.php?id=<?php echo $value['user_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')">EDIT</a></td>
            <td><a href="deleteuserAdmin.php?id=<?php echo $value['user_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td>
        </tr>
    <?php
    }
}elseif(isset($_POST['sort']) && $sort == "descending"){
    foreach($sortDate as $value){
    
        
    ?>
        
        <tr>
            <td><?php echo $value['user_id']; ?></td>
            <td><?php echo $value['username']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['dateofsignup']; ?></td>
            <td><?php echo $value['mobile']; ?></td>
            <td><?php if($value['isblock'] == 1) { echo "Unblock";} else{ echo "BLOCK";} ?></td>
            <!-- <td><?php echo $value['password']; ?></td>
            <td><?php echo $value['is_admin']; ?></td> -->
            <td><a href="edituserAdmin.php?id=<?php echo $value['user_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')">EDIT</a></td>
            <td><a href="deleteuserAdmin.php?id=<?php echo $value['user_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td>
        </tr>
    <?php
    }
}elseif(isset($_POST['sort']) && $sort == "asc"){
    foreach($sortName as $value){
    
    ?>
        <tr>
        <td><?php echo $value['user_id']; ?></td>
            <td><?php echo $value['username']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['dateofsignup']; ?></td>
            <td><?php echo $value['mobile']; ?></td>
            <td><?php if($value['isblock'] == 1) { echo "Unblock";} else{ echo "BLOCK";} ?></td>
            <!-- <td><?php echo $value['password']; ?></td>
            <td><?php echo $value['is_admin']; ?></td> -->
            <td><a href="edituserAdmin.php?id=<?php echo $value['user_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')">EDIT</a></td>
            <td><a href="deleteuserAdmin.php?id=<?php echo $value['user_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td>
        </tr>
    <?php
    }
}elseif(isset($_POST['sort']) && $sort == "desc"){
    foreach($sortName as $value){
        
    ?>
        <tr>
        <td><?php echo $value['user_id']; ?></td>
            <td><?php echo $value['username']; ?></td>
            <td><?php echo $value['email']; ?></td>
            <td><?php echo $value['dateofsignup']; ?></td>
            <td><?php echo $value['mobile']; ?></td>
            <td><?php if($value['isblock'] == 1) { echo "Unblock";} else{ echo "BLOCK";} ?></td>
            <!-- <td><?php echo $value['password']; ?></td>
            <td><?php echo $value['is_admin']; ?></td> -->
            <td><a href="edituserAdmin.php?id=<?php echo $value['user_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')">EDIT</a></td>
            <td><a href="deleteuserAdmin.php?id=<?php echo $value['user_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td>
        </tr>
    <?php
    }
}else{
                  
                    foreach($locate as $value){
                        
                    ?>
                        
                        <tr>
                            <td><?php echo $value['user_id']; ?></td>
                            <td><?php echo $value['username']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo $value['dateofsignup']; ?></td>
                            <td><?php echo $value['mobile']; ?></td>
                            <td><?php if($value['isblock'] == 1) { echo "Unblock";} else{ echo "BLOCK";} ?></td>
                            <!-- <td><?php echo $value['password']; ?></td>
                            <td><?php echo $value['is_admin']; ?></td> -->
                            <td><a href="edituserAdmin.php?id=<?php echo $value['user_id']; ?>" title='Edit' onclick="return confirm('Are you sure?')">EDIT</a></td>
							<td><a href="deleteuserAdmin.php?id=<?php echo $value['user_id']; ?>" title='Delete' onclick="return confirm('Are you sure?')">DELETE</a></td>
                        </tr>
                    <?php
                    }}?>
        </table>
    </body>
</html>