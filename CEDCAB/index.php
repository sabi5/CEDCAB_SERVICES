<?php 
    session_start();
    require "Ridedetails.php";
    // require "Bookrides.php";
    require "Dbconnection.php";
    require "Location.php";

    $cab_info =array(
        "Charbagh"=>0, 
        "Indira Nagar"=>10,
        "BBD"=>30,
        "Barabanki"=>60,
        "Faizabad"=>100,
        "Basti"=>150,
        "Gorakhpur"=>210
    );
    
    $ride = new Ridedetails();
    // $ride = new Bookrides();
    $Connection = new Dbconnection();
    $location = new Location();  
    $locate = $location->place($Connection->con);
    
    if(isset($_POST['finalsubmit'])){
        $sql = $ride->ride( $Connection->con);
    }
   
    if(isset($_POST['submit'])){
        $pickup = $_POST['pickup'];
        $drop = $_POST['drop'];
        $cabtype = $_POST['cabtype'];
        $luggage = $_POST['luggage'];

        foreach($cab_info as $key=>$value){
            if($pickup == $key){
                $pick_distance = $value;
                
                foreach($cab_info as $key=>$value){
                    if($drop == $key){
                        $drop_distance = $value ;
                    }
                }
            }
        }
        $distance = $drop_distance - $pick_distance;
        if($distance<0){
            $distance = $distance * (-1);
            // $_SESSION['distance'] = $distance;
        }
        $_SESSION['distance'] = $distance;
        
        if($cabtype == "CedMicro"){
            $fixed_fare = 50;
            if($distance <=10){
                $final_fare = $fixed_fare + ($distance * 13.50);
            }
            elseif($distance <= 50){ 
                $final_fare = $fixed_fare + (($distance-10)* 12.00);
                $final_fare += 10 * 13.50;
            }
            elseif($distance <= 100){
                $final_fare = $fixed_fare + (($distance-60)* 10.20);
                $final_fare += 10 * 13.50;
                $final_fare += 50 * 12.00;
            }
            elseif($distance > 100){
                $final_fare = $fixed_fare + (($distance - 160)* 8.50);
                $final_fare += 10 * 13.50;
                $final_fare += 50 * 12.00;
                $final_fare += 100 * 10.20;
            }
        }
        elseif($cabtype == "CedMini"){
            $fixed_fare = 150;
            if($distance <=10){
                $final_fare = $fixed_fare + ($distance * 14.50);
                if($luggage <=10){
                    $final_fare += 50; 
                }
                elseif($luggage >10 && $luggage <=20){
                    $final_fare += 100;
                }
                elseif($luggage >20){
                    $final_fare += 200;
                }
            }
            elseif($distance <= 50){
                $final_fare = $fixed_fare + (($distance -10 ) * 13.00);
                $final_fare += 10 * 14.50;

                if($luggage <=10){
                    $final_fare += 50; 
                }
                elseif($luggage >10 && $luggage <=20){
                    $final_fare += 100;
                }
                elseif($luggage >20){
                    $final_fare += 200;
                }
            }
            elseif($distance <= 100){
                $final_fare = $fixed_fare + (($distance - 60) * 11.20);
                $final_fare += 10 * 14.50;
                $final_fare += 50 * 13.00;
                if($luggage <=10){
                    $final_fare += 50; 
                }
                elseif($luggage >10 && $luggage <=20){
                    $final_fare += 100;
                }
                elseif($luggage >20){
                    $final_fare += 200;
                }
            }
            elseif($distance > 100){
                $final_fare = $fixed_fare + (($distance -160)* 9.50);
                $final_fare += 10 * 14.50;
                $final_fare += 50 * 13.00;
                $final_fare += 100 * 11.20;
                if($luggage <=10){
                    $final_fare += 50; 
                }
                elseif($luggage >10 && $luggage <=20){
                    $final_fare += 100;
                }
                elseif($luggage >20){
                    $final_fare += 200;
                }
            }
        }
        elseif($cabtype == "CedRoyal"){
            $fixed_fare = 200;
            if($distance <=10){
                $final_fare = $fixed_fare + ($distance * 15.50);

                if($luggage <=10){
                    $final_fare += 50; 
                }
                elseif($luggage >10 && $luggage <=20){
                    $final_fare += 100;
                }
                elseif($luggage >20){
                    $final_fare += 200;
                }
            }
            elseif( $distance <= 50){
                $final_fare = $fixed_fare + (($distance -10)* 14.00);
                $final_fare += 10 * 15.50;
                if($luggage <=10){
                    $final_fare += 50; 
                }
                elseif($luggage >10 && $luggage <=20){
                    $final_fare += 100;
                }
                elseif($luggage >20){
                    $final_fare += 200;
                }
            }
            elseif($distance <= 100){
                $final_fare = $fixed_fare + (($distance -60)* 12.20);
                $final_fare += 10 * 15.50;
                $final_fare += 50 * 14.00;
                if($luggage <=10){
                    $final_fare += 50; 
                }
                elseif($luggage >10 && $luggage <=20){
                    $final_fare += 100;
                }
                elseif($luggage >20){
                    $final_fare += 200;
                }
            }
            elseif($distance > 100){
                $final_fare = $fixed_fare + (($distance-160) * 10.50);
                $final_fare += 10 * 15.50;
                $final_fare += 50 * 14.00;
                $final_fare += 100 * 12.20;
            
                if($luggage <=10){
                    $final_fare += 50; 
                }
                elseif($luggage >10 && $luggage <=20){
                    $final_fare += 100;
                }
                elseif($luggage >20){
                    $final_fare += 200;
                }
            }
        }
        elseif($cabtype == "CedSUV"){
            $fixed_fare = 250;
            if($distance <=10){
                $final_fare = $fixed_fare + ($distance * 16.50);
                
                if($luggage <=10){
                    $final_fare += 2 * (50); 
                }
                elseif($luggage >10 && $luggage <=20){
                    $final_fare += 2 * (100);
                }
                elseif($luggage >20){
                    $final_fare += 2 * (200);
                }
            }
            elseif($distance <= 50){
                $final_fare = $fixed_fare + (($distance -10)* 15.00);
                $final_fare += 10 * 16.50;
               
                if($luggage <=10){
                    $final_fare += 2 * (50);
                }
                elseif($luggage >10 && $luggage <=20){
                    $final_fare += 2 * (100);
                }
                elseif($luggage >20){
                    $final_fare += 2 * (200);
                }
            }
            elseif($distance <= 100){
                $final_fare = $fixed_fare + (($distance - 60)* 13.20);
                $final_fare += 10 * 16.50;
                $final_fare += 50 * 15.00;

                if($luggage <=10){
                    $final_fare += 2 * (50); 
                }
                elseif($luggage >10 && $luggage <=20){
                    $final_fare += 2 * (100);
                }
                elseif($luggage >20){
                    $final_fare += 2 * (200);
                }
            }
            elseif($distance > 100){
                $final_fare = $fixed_fare + (($distance - 160) * 11.50);
                $final_fare += 10 * 16.50;
                $final_fare += 50 * 15.00;
                $final_fare += 100 * 13.20;
            
                if($luggage <=10){
                    $final_fare += 2 * (50); 
                }
                elseif($luggage >10 && $luggage <=20){
                    $final_fare += 2 * (100);
                }
                elseif($luggage >20){
                    $final_fare += 2 * (200);
                }
            }
        }
       
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index Cedcab</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="booking.css">

    </head>
    <body> 
        <header>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                    <nav class="navbar navbar-expand-md navbar-light bg-dark">
                        <div class="container ">
                            <a class="navbar-brand text-warning font-weight-bold" href="#"><span>CED </span><span id="cab">CAB</span></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarCollapse">
                                <ul class="navbar-nav ml-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link text-warning" href="#">Home <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                   
                                        <a class="nav-link text-warning" href="login.php">LOGIN</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div> 
        </header>

        <!-- BODY SECTION -->
        
        <section>
            <div class=".fluid-container text-center" id="head" >
                <h2 class="pb-2 font-weight-bold font-style-italic" id="heading">
                Book a city taxi
                </h2>
                <p class="font-weight-bold" id="para">
                Choose from a range of categories and prices
                </p>

        
                <div class="container">
                    <div class="row text-left ">
                        <div class="col-lg-7 city">
                            <form action="index.php" method="post">
                                <h2 class="text-center head-city mt-3 pl-4">CITY TAXI</h2>
                                <p class="text-center sub-city">Your everyday travel partner</p>
                                <p class="text-center sub-city">AC cabs for point to point travel</p>
                                <p>
                                <div class="form-group row">
                                    <label for="pickup" class="col-sm-2 col-form-label">PICKUP </label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="pickup">
                                        <?php 
                                            foreach($locate as $value){
                                                ?>
                                                <option value="<?php echo $value['name'];?>"><?php echo $value['name'];?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                </p>
                                <p>
                                <div class="form-group row">
                                    <label for="drop" class="col-sm-2 col-form-label">DROP</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="drop">
                                        <?php 
                                            foreach($locate as $value){
                                                ?>
                                                <option value="<?php echo $value['name'];?>"><?php echo $value['name'];?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                </p>
                                <p>
                                <div class="form-group row">
                                    <label for="cabtype" class="col-sm-2 col-form-label">CAB TYPE</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="cabtype" id="select" onchange = "myfunc()" required>
                                            <option value="">Drop down to select Cab type</option>
                                            <option value="CedMicro">CedMicro</option>
                                            <option value="CedMini">CedMini</option>
                                            <option value="CedRoyal">CedRoyal</option>
                                            <option value="CedSUV">CedSUV</option>
                                        </select>
                                    </div>
                                </div>
                                </p>
                                
                                <div id="lug" class="form-group row">
                                    <label for="luggage" class="col-sm-2 col-form-label">LUGGAGE</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" placeholder="Enter weight in KG" onkeypress="return myFunction()" name="luggage">
                                    </div>
                                    <br>
                                </div>
                                
                                <p>
                                    <input type="submit" data-toggle="modal" data-target="#exampleModal" name="submit" value="CALCULATE FARE" class="btn form-control font-weight-bold cabbutton" id="submit" required >
                                </p>
                                
                                
                                <p class="bg-info text-center ">
                                    
                                <?php
                                if(isset($final_fare)){
                                    echo "<marquee>For confirm booking, click <b style = color:red;>BOOK NOW</b> button </marquee></br>";
                                    echo " FINAL FARE : Rs. ".$final_fare. " /-</br>";
                                    echo " DISTANCE : ".$distance. " km</br> ";
                                    echo " PICKUP : ".$pickup. "</br> ";
                                    echo " DROP : ".$drop. "</br> ";
                                    echo " LUGGAGE : ".$luggage. " kg</br> ";
                                    echo " CABTYPE : ".$cabtype. "</br> ";
                                ?>
                                <!-- <input type="submit" name ="submit" value ="Book Now"> -->
                                <!-- <button type ="submit" name ="submit">Book Now</button> -->
                                <?php
                                
                                }else{
                                    echo "";
                                }
                                ?>
                                
                                </p>
                                <div class= "text-center">
                                <button type="submit" name ="finalsubmit" id="button" value="Book Now" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary" required>BOOK NOW</button></div>
                                </form>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <form action="index.php" method ="post">
                                <div class="modal-body">
                                    ...hello
                                
                                    <p class="bg-info text-center ">
                            
                                        <?php
                                        if(isset($final_fare)){
                                        
                                            $_SESSION['final'] = $final_fare;
                                            echo " FINAL FARE : Rs. ".$final_fare. " /-</br>";
                                            echo " DISTANCE : ".$distance. " km</br> ";
                                            echo " PICKUP : ".$pickup. "</br> ";
                                            echo " DROP : ".$drop. "</br> ";
                                            echo " LUGGAGE : ".$luggage. " kg</br> ";
                                            echo " CABTYPE : ".$cabtype. "</br> ";
                                        ?>
                                        
                                        <!-- <input type="submit" name ="submit" value ="Book Now"> -->
                                        <?php
                                        
                                        }else{
                                            echo "";
                                        }
                                        
                                        ?>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <!-- <button type="button" class="btn btn-primary">Book Now</button> -->
                                    <input type="submit" name ="finalsubmit" value="Book Now" class="btn btn-primary" required >
                                </div>
                            </form>

                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--  -->
        <script>
            
            function myfunc(){
               
                // var x = document.getElementById("select").value;
                
                if($final_fare){
                    document.getElementById("button").style.display = "flex";
                } else {
                    document.getElementById("button").style.display = "none";
                }
            }
            function myFunction() {
                var x;
                x = document.getElementById("lug").value;

                if ((event.keyCode > 48) && (event.keyCode < 58)) {
                    return true;
                } else {
                    alert('Please enter numeric value only !');
                    return false;
                }
                
            }
        </script>
         <!-- footer -->
        <footer  style="background-color: #2c292f">
            <div class="container">
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
