<?php
session_start();
require "../Dbconnection.php";
// require "User.php";

$Connection = new Dbconnection();
$conn = $Connection->con;

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    

    $insert = " UPDATE `tbl_ride` SET `status` = '$status' WHERE  `ride_id` = '$id' ";
    
    $uquery = mysqli_query($conn, $insert);
    
    if ($uquery) {
        echo '<script> alert("Updated successfully")</script>';
        ?>
        <script>location.replace("admin.php")</script>
        <?php
    }
}

$id = $_GET['id'];

$query = "SELECT * FROM `tbl_ride` WHERE `ride_id`='$id'";
$result = mysqli_query($conn, $query)or die($mysqli_error($conn));
$row = mysqli_fetch_assoc($result); 
if ($row) {
    $status = $row['status'];
    
} else {
        echo '<script> alert("No data found"); </script>';
}
  
?>
<html>
    <head>
        <title>UPDATE STATUS</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    </head>
    <body>
        <div id="wrapper">
            <div class="container form">
                <h2>Update Status</h2><br>
                <form action="editstatus.php" method="POST">
                    <p>
                        <label for="status">Status : <input type="number" 
                         name="status" value="<?php  echo $status; ?>" required></label>
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
