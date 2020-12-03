<?php
 
session_start();

require "../Dbconnection.php";
require "../User.php";

if (isset($_POST['submit'])) {
    $username =  $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['password2'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];

    $User = new User();
    $Connection = new Dbconnection();

    $sql = $User->signup($username, $password, $repassword, $email, $mobile, $Connection->con);
    echo $sql;

}
if (!isset($_SESSION['user']['username'])) {     
    echo '<script>alert("You are logged out")</script>';
   ?>
   <script>location.replace("../login.php")</script> 
    <?php
}
?>

<html>
    <head>
        <title>Add User</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        
    </head>
    <body>
    <header>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <nav class="navbar navbar-expand-md navbar-light bg-dark">
                        <div class="container ">
                            <a class="navbar-brand text-warning font-weight-bold" href="admin.php"><span>CED </span><span id="cab">CAB</span></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link text-warning" href="admin.php">Dashboard <span class="sr-only">(current)</span></a>
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
                <h2 class = "mt-5">Sign Up</h2><br>
                <form action="adduser.php" method="POST" >
                    <p>
                        <label for="username">Username : <input type="text" 
                         name="username" class ="form-control" required></label>
                    </p>
                    <p>
                        <label for="password">Password : <input type="password" 
                        name="password" class ="form-control" required></label>
                    </p>
                    <p>
                        <label for="password2">Re-Password : <input type="password" 
                        name="password2" class ="form-control" required></label>
                    </p>
                    <p>
                        <label for="email">Email : <input type="email" name="email" class ="form-control"
                        required></label>
                    </p>
                    <p>
                        <label for="number">Mobile no. : <input type="number" name="mobile" class ="form-control" 
                        required></label>
                    </p> 
                  
                    <p>
                        <input class="btn btn-success" type="submit" name="submit" value="Submit">
                    </p>
                    
                </form>
                <a href="admin.php"><button class="btn btn-warning">BACK</button> </a>
                <!-- <a href="login.php"><button class="btn btn-primary">LOGIN</button> </a> -->
            </div>
        </div>
         <!-- footer -->
         <footer  style="background-color: #2c292f">
            <div class="container" style="margin-top: 50px;">
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
