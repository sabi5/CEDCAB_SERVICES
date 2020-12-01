<?php
session_start();
require "../Dbconnection.php";
// require "User.php";

$Connection = new Dbconnection();
$conn = $Connection->con;

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $distance = $_POST['distance'];
    $is_available = $_POST['available'];

    $insert = "UPDATE `tbl_location` SET `name` = '$name', `distance`='$distance', `is_available` = '$is_available' WHERE `id` = '$id' ";
    
    $uquery = mysqli_query($conn, $insert);
    
    if ($uquery) {
        echo '<script> alert("Updated successfully")</script>';
        ?>
        <script>location.replace("admin.php")</script>
        <?php
    }
}

$id = $_GET['id'];

$query = "SELECT *FROM `tbl_location` WHERE `id`='$id'";
$result = mysqli_query($conn, $query)or die($mysqli_error($conn));
$row = mysqli_fetch_assoc($result); 
if ($row) {
    $name = $row['name'];
    $distance = $row['distance'];
    $is_available = $row['is_available'];
} else {
        echo '<script> alert("No data found"); </script>';
}
  
?>
<html>
    <head>
        <title>UPDATE Location</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    </head>
    <body>
    <div id="wrapper">
            <div class="container form">
                <h2>UPDATE LOCATION</h2><br>
                <form action="editLocation.php" method="POST">
                    <p>
                        <label for="name">Location : <input type="text" 
                         name="name"  value="<?php echo $name;?>" required></label>
                    </p>
                    <p>
                        <label for="distance">Distance : <input type="number" 
                        name="distance" value="<?php echo $distance;?>" required></label>
                    </p>
                    <p>
                        <label for="available">Is_available : <input type="number" 
                        name="available" value="<?php echo $is_available;?>" required></label>
                    </p>
                    <input type="hidden" name="id" value="<?php  echo $id; ?>" 
					style="display:none;">
                    <p>
                        <input class="btn btn-success" type="submit" name="submit" value="Submit">
                    </p>
                    
                </form>
                <a href="admin.php"><button class="btn btn-primary">DASHBOARD</button> </a>
            </div>
        </div>
    </body>
</html>
