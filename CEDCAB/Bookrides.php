<?php 
// require "User.php";

    class Bookrides{
        public $ride_id;
        public $ride_date;
        public $pickup;
        public $drop;
        public $distance;
        public $luggage;
        public $final_fare;
        public $status;
        public $customer_user_id;
        public $cabtype;
        public $con;
        

        function ride($pickup, $drop,$cabtype, $luggage, $distance, $final_fare, $con){

            $customer_user_id = $_SESSION['user']['id'];
            // echo $customer_user_id;

            $final_fare = $_SESSION['final'];
            $distance = $_SESSION['distance'];
            // echo "distance".$distance;


            if(isset($_POST['submit']) && !isset($_SESSION['user'])){
                echo "<script>alert('please login first');</script>";
                echo  "<script>location.replace('login.php');</script>";
            }else{

                if (isset($_POST['submit'])) {

                    $insertquery = "INSERT INTO tbl_ride (ride_date, pick_place, drop_place, cab_type, total_distance, luggage, total_fare, status, customer_user_id) 
                            VALUES (NOW(), '$pickup', '$drop', '$cabtype','$distance', '$luggage', '$final_fare', 1, '$customer_user_id' )";
        
                    $iquery = mysqli_query($con, $insertquery);


                    
                    if ($iquery) {
                        echo "<script>alert('Inserted Successful');</script>";
                        echo  "<script>location.replace('customer.php');</script>";
                        
                    } else {
                        echo "<script>alert('Not inserted');</script>";
                    }
                
                }
            }
        }

       
    }

    



?>