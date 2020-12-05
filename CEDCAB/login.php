<?php

session_start();

require "Dbconnection.php";
require "User.php";

if(isset($_SESSION['user']['username']) && $_SESSION['user']['is_admin'] == 1){
    echo  "<script>location.replace('admin/admin.php');</script>";
}elseif(isset($_SESSION['user']['username']) && $_SESSION['user']['is_admin'] == 0){
    echo  "<script>location.replace('customer.php');</script>";
}

if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    // $checked = $_POST['remember_me'];
    $User = new User();
    $Connection = new Dbconnection();

   
    $sql = $User->login($email, $password, $Connection->con);
    echo $sql;
}


?>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../sidebar.css">
        <style>
            body {
                background-color: lightcyan;
            }
        </style>
        
    </head>
    <body id = "body">
  
        <header>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <nav class="navbar navbar-expand-md navbar-light bg-dark">
                        <div class="container ">
                            <a class="navbar-brand text-warning font-weight-bold" href="#"><span>CED </span><span style="color:chartreuse">CAB</span></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link text-warning" href="index.php">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                   
                                        <a class="nav-link text-warning" href="signup.php">SIGNUP</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div> 
        </header>
        <div class="container form" >
       
            <div id="login-form" class ="float-center" style ="padding-left: 350px; ">
                <h2 class ="mt-5">Login</h2><br>
                <form action="login.php" method="POST">
                    <p>
                        <label for="email">Email : <input type="email" name="email" value = "<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email'];
                        } ?>" class ="form-control" required></label>
                    </p>
                    <p>
                        <label for="password">Password : <input type="password" name="password" value = "<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password'];
                        } ?>" class ="form-control" required></label>
                    </p>
                   
                    <p>
                        <input class="btn btn-success" type="submit" name="submit" value="Login">
                    </p>
                    
                </form>
                <a href="signup.php"><button class="btn btn-primary">SIGN UP</button></a> <span> Don't have an account yet?</span>
            </div>
        </div>
        <!-- footer -->
        <footer  style="background-color: #2c292f">
            <div class="container" style="margin-top: 200px;">
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
