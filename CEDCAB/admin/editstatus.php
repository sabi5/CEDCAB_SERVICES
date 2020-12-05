<?php
session_start();
require "../Dbconnection.php";
// require "User.php";

$Connection = new Dbconnection();
$conn = $Connection->con;

// if(($_SESSION['user']['is_admin'] != 1)){
//     echo '<script>alert("You are unauthorised person")</script>';
//     ?>
<!-- // <script>location.replace("../customer.php")</script>  -->
    <?php
// }

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];
    

    $insert = " UPDATE `tbl_ride` SET `status` = '$status' WHERE  `ride_id` = '$id' ";
    
    $uquery = mysqli_query($conn, $insert);
    
    if ($uquery) {

        if($status == 1){
            echo '<script> alert("pending ride status updated successfully")</script>';
            ?>
            <script>location.replace("admin.php")</script>
            <?php
        }elseif($status == 2){
            echo '<script> alert("Ride has been Completed Successfully")</script>';
            ?>
            <script>location.replace("admin.php")</script>
            <?php
        }elseif($status == 0){
            echo '<script> alert("Ride has been Cancelled")</script>';
            ?>
            <script>location.replace("admin.php")</script>
            <?php
        }
        // echo '<script> alert("Updated successfully")</script>';
        ?>
        <!-- <script>location.replace("admin.php")</script> -->
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
    <header>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <nav class="navbar navbar-expand-md navbar-light bg-dark">
                        <div class="container ">
                            <a class="navbar-brand text-warning font-weight-bold" href="admin.php"><span>CED </span><span style="color:chartreuse">CAB</span></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link text-warning" href="admin.php">DASHBOARD <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                   
                                        <a class="nav-link text-warning" href="../logout.php">LOGOUT</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div> 
        </header>
        <div id="wrapper">
            <div class="container form">
                <h2 class ="mt-5">Update Status</h2><br>
                <form action="editstatus.php" method="POST">
                    <p>
                        <label for="status">Status : </label>
                         <select name="status" required>
                            <option value="" disabled selected><?php if($status == 1){echo "Pending";}elseif($status == 2){ echo "Completed"; }else{ echo "Cancelled";}?></option>
                            <option value="1">pending</option>
                            <option value="2">complete</option>
                            <option value="0">cancel</option>
                            
                           
                        </select>
                    </p>
                    
					<input type="hidden" name="id" value="<?php  echo $id; ?>" 
					style="display:none;">
                    <p>
                        <input class="btn btn-success" type="submit" name="submit" value="Submit">
                    </p>
                    
                </form>
                <a href="admin.php"><button class="btn btn-primary">DASHBOARD</button> </a>
                <a href="pendingRide.php"><button class="btn btn-warning">BACK</button> </a>
            </div>
        </div>
        <!-- footer -->
        <footer  style="background-color: #2c292f">
            <div class="container" style="margin-top: 150px;">
                <div class="row ">
                    <div class="col-md-4 text-center text-md-left ">
                        
                        <div class="py-0">
                            <h3 class="my-4 text-white">About<span class="mx-2 font-italic text-warning ">Cedcab</span></h3>

                            <p class="footer-links font-weight-bold">
                                <a class="text-white" href="#">Home</a>
                                |
                                <a class="text-white" href="#">Blog</a>
                                |
                                <a class="text-white" href="#">About</a>
                                |
                                <a class="text-white" href="#">Contact</a>
                            </p>
                            <p class="text-light py-4 mb-4">&copy;2020 Cedcab Pvt. Ltd.</p>
                        </div>
                    </div>
                    
                    <div class="col-md-4 text-white text-center text-md-left ">
                        <div class="py-2 my-4">
                            <div>
                                <p class="text-white"> <i class="fa fa-map-marker mx-2 "></i>
                                Gomti Nagar</p>
                            </div>

                            <div> 
                                <p><i class="fa fa-phone  mx-2 "></i> +91 22-27782183</p>
                            </div>
                            <div>
                                <p><i class="fa fa-envelope  mx-2"></i><a href="mailto:support@eduonix.com">support@cedcab.com</a></p>
                            </div>  
                        </div>  
                    </div>
                    
                    <div class="col-md-4 text-white my-4 text-center text-md-left ">
                        <span class=" font-weight-bold ">About the Company</span>
                        <p class="text-warning my-2" > XYZ</p>
                        <div class="py-2">
                            <a href="#"><i class="fab fa-facebook fa-2x text-primary mx-3"></i></a>
                            <a href="#"><i class="fab fa-google-plus fa-2x text-danger mx-3"></i></a>
                            <a href="#"><i class="fab fa-twitter fa-2x text-info mx-3"></i></a>
                            <a href="#"><i class="fab fa-youtube fa-2x text-danger mx-3"></i></a>
                        </div>
                    </div>
                </div>  
            </div>
        </footer>

        <!-- end of footer -->
    </body>
</html>
