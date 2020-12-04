<?php
    session_start();
    require "Dbconnection.php";
    // require "User.php";

    if(($_SESSION['user']['is_admin'] != 0)){
        echo '<script>alert("You are unauthorised person")</script>';
        ?>
    <script>location.replace("admin/admin.php")</script> 
        <?php
    }

    $Connection = new Dbconnection();
    $conn = $Connection->con;


    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "SELECT *FROM `tbl_user` WHERE `user_id`='$id'";
        $result = mysqli_query($conn, $query)or die($mysqli_error($conn));
        $row = mysqli_fetch_assoc($result); 
        if ($row) {
            $username= $row['username'];
        
            $mobile= $row['mobile'];
        } else {
                echo '<script> alert("No data found"); </script>';
        }
    }

    elseif (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $username = $_POST['username'];
        // $password = $_POST['password'];
        // $email = $_POST['email'];
        $mobile = $_POST['mobile'];

        if ( !ctype_alpha($username))  {
        
            echo "<script>alert('Enter alphabets only');</script>"; 
        
        }else {
            $id = $_POST['id'];
            $insert = " UPDATE tbl_user SET `username` = '$username', 
                    `mobile`='$mobile' WHERE  `user_id` = '$id' ";
            
            $uquery = mysqli_query($conn, $insert);

            $_SESSION['user']['username'] = $username;
            
            if ($uquery) {
                echo '<script> alert("Updated successfully")</script>';
                ?>
                <script>location.replace("customer.php")</script>
                <?php
            }
        }
    }

?>
<html>
    <head>
        <title>UPDATE User</title>
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
                            <a class="navbar-brand text-warning font-weight-bold" href="customer.php"><span>CED </span><span style="color:chartreuse">CAB</span></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link text-warning" href="customer.php">Dashboard <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                   
                                        <a class="nav-link text-warning" href="logout.php">LOGOUT</a>
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
                <h2 class ="mt-5">Update Details</h2><br>
                <form action="edituser.php" method="POST">
                    <p>
                        <label for="username">Username : <input type="text" 
                         name="username" value="<?php  echo $username; ?>" required></label>
                    </p>
                    
                    <p>
                        <label for="number">Mobile no. : <input type="number" name="mobile" 
                        value="<?php  echo $mobile; ?>" required></label> (Must be 10 digits only)
                    </p> 
					<input type="hidden" name="id" value="<?php  echo $id; ?>" 
					style="display:none;">
                    <p>
                        <input class="btn btn-success" type="submit" name="submit" value="Submit">
                    </p>
                    
                </form>
                <a href="manageCustomer.php"><button class="btn btn-primary">BACK</button> </a>
                <a href="customer.php"><button class="btn btn-warning">DASHBOARD</button> </a>
            </div>
        </div>
        <!-- footer -->
        <footer  style="background-color: #2c292f">
            <div class="container" style="margin-top: 100px;">
                <div class="row">
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
                                        309 - Rupa Solitaire,
                                    Bldg. No. A - 1, Sector - 1
                                    Mahape, Navi Mumbai - 400710</p>
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
