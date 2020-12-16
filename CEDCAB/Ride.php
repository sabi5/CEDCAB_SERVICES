<?php 
    class Ride{

        public $con;
        public $selected;
        public $sort;
        

        function ridedetails($con){
            
            $data =array();

            $user_id = $_SESSION['user']['id'];
            
            $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id'";
        
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }

        function invoice($con){
            
            $id = $_GET['id'];
            
            $sqlname = "SELECT * FROM `tbl_ride` WHERE `ride_id` = '$id'";
            $query = $con->query($sqlname);
            $row = $query->fetch_assoc();
            $userid = $row['customer_user_id'];

            $sqlname = "SELECT * FROM `tbl_user` WHERE `user_id` = '$userid'";
            $query = $con->query($sqlname);
            $row = $query->fetch_assoc();
            $name = $row['username'];
            $_SESSION['ride_username'] = $name;

            $data =array();

            $user_id = $_SESSION['user']['id'];
            
            $sql = "SELECT * FROM `tbl_ride` WHERE `ride_id` = '$id'";
        
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){

                    $data[] = $row;
                }
                return $data;
            }
        }

        function pendingRides($con){
            
            $data =array();

            $user_id = $_SESSION['user']['id'];
            
            $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id' AND `status` = '1'";
        
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }

        function completeRides($con){
            
            $data =array();

            $user_id = $_SESSION['user']['id'];
            
            $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id' AND `status` = '2'";
        
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }

        // ********************************* filter for All Rides
        
        function filterAll($selected,$con){
           
            $data =array();

            $user_id = $_SESSION['user']['id'];

           
            if($selected == "last 7 days"){
                $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND `customer_user_id` = '$user_id'";
              
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "last 30 days"){
                $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND `customer_user_id` = '$user_id'";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }elseif($selected == "No filter"){
                $data =array();

            $user_id = $_SESSION['user']['id'];
            
            $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id'";
        
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
            }
            elseif($selected == "CedMicro"){
                $user_id = $_SESSION['user']['id'];

                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `customer_user_id` = '$user_id'";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedMini"){
                $user_id = $_SESSION['user']['id'];

                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `customer_user_id` = '$user_id'";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedRoyal"){
                $user_id = $_SESSION['user']['id'];

                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `customer_user_id` = '$user_id'";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedSUV"){
                $user_id = $_SESSION['user']['id'];

                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `customer_user_id` = '$user_id'";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                       
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        function sortAll($sort,$con){
           
            $data =array();

            $user_id = $_SESSION['user']['id'];

            if($sort == "ascending"){
                
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id' ORDER BY `ride_date` ASC ";
               
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                      
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id' ORDER BY `ride_date` DESC ";
                
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        function fareAll($sort,$con){
           
            $data =array();

            $user_id = $_SESSION['user']['id'];

            if($sort == "asc"){
                // SELECT * FROM Customers ORDER BY CITY DESC;
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id' ORDER BY `total_fare` ASC ";
               
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id' ORDER BY `total_fare` DESC ";
                
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        function cabtypeAll($sort,$con){
           
            $data =array();

            $user_id = $_SESSION['user']['id'];

            if($sort == "cab asc"){
                // SELECT * FROM Customers ORDER BY CITY DESC;
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id' ORDER BY `cab_type` ASC ";
               
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id' ORDER BY `cab_type` DESC ";
                
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

         // *******************************filter pending
         function filter($selected,$con){
           
            $data =array();

            $user_id = $_SESSION['user']['id'];

           
            if($selected == "last 7 days"){
                $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND `customer_user_id` = '$user_id' AND `status` = 1";
              
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "last 30 days"){
                $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND `customer_user_id` = '$user_id' AND `status` = 1";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }elseif($selected == "No filter"){
                $data =array();

            $user_id = $_SESSION['user']['id'];
            
            $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id' AND `status` = '1'";
        
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
            }
            elseif($selected == "CedMicro"){
                $user_id = $_SESSION['user']['id'];

                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `customer_user_id` = '$user_id' AND `status` = 1";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedMini"){
                $user_id = $_SESSION['user']['id'];

                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `customer_user_id` = '$user_id' AND `status` = 1";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedRoyal"){
                $user_id = $_SESSION['user']['id'];

                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `customer_user_id` = '$user_id'  AND `status` = 1";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedSUV"){
                $user_id = $_SESSION['user']['id'];

                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `customer_user_id` = '$user_id'  AND `status` = 1";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                       
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        function sort($sort,$con){
           
            $data =array();

            $user_id = $_SESSION['user']['id'];

            if($sort == "ascending"){
                
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id'  AND `status` = 1 ORDER BY `ride_date` ASC ";
               
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                      
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id'  AND `status` = 1 ORDER BY `ride_date` DESC ";
                
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        function fare($sort,$con){
           
            $data =array();

            $user_id = $_SESSION['user']['id'];

            if($sort == "asc"){
                // SELECT * FROM Customers ORDER BY CITY DESC;
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id'  AND `status` = 1 ORDER BY `total_fare` ASC ";
               
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id'  AND `status` = 1 ORDER BY `total_fare` DESC ";
                
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        function cabtype($sort,$con){
           
            $data =array();

            $user_id = $_SESSION['user']['id'];

            if($sort == "cab asc"){
                // SELECT * FROM Customers ORDER BY CITY DESC;
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id'  AND `status` = 1 ORDER BY `cab_type` ASC ";
               
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id'  AND `status` = 1 ORDER BY `cab_type` DESC ";
                
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        // ******************** filter complete

        function filterComplete($selected,$con){
           
            $data =array();

            $user_id = $_SESSION['user']['id'];

           
            if($selected == "last 7 days"){
                $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND `customer_user_id` = '$user_id' AND `status` = 2";
              
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "last 30 days"){
                $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND `customer_user_id` = '$user_id' AND `status` = 2";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }elseif($selected == "No filter"){
                $data =array();

            $user_id = $_SESSION['user']['id'];
            
            $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$user_id' AND `status` = '2'";
        
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
            }
            elseif($selected == "CedMicro"){
                $user_id = $_SESSION['user']['id'];

                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `customer_user_id` = '$user_id' AND `status` = 2";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedMini"){
                $user_id = $_SESSION['user']['id'];

                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `customer_user_id` = '$user_id' AND `status` = 2";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedRoyal"){
                $user_id = $_SESSION['user']['id'];

                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `customer_user_id` = '$user_id'  AND `status` = 2";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedSUV"){
                $user_id = $_SESSION['user']['id'];

                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `customer_user_id` = '$user_id'  AND `status` = 2";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                       
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        function sortComplete($sort,$con){
           
            $data =array();

            $user_id = $_SESSION['user']['id'];

            if($sort == "ascending"){
                
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id'  AND `status` = 2 ORDER BY `ride_date` ASC ";
               
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                      
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id'  AND `status` = 2 ORDER BY `ride_date` DESC ";
                
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        function fareComplete($sort,$con){
           
            $data =array();

            $user_id = $_SESSION['user']['id'];

            if($sort == "asc"){
                // SELECT * FROM Customers ORDER BY CITY DESC;
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id'  AND `status` = 2 ORDER BY `total_fare` ASC ";
               
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id'  AND `status` = 2 ORDER BY `total_fare` DESC ";
                
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        function cabtypeComplete($sort,$con){
           
            $data =array();

            $user_id = $_SESSION['user']['id'];

            if($sort == "cab asc"){
                // SELECT * FROM Customers ORDER BY CITY DESC;
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id'  AND `status` = 2 ORDER BY `cab_type` ASC ";
               
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_ride` WHERE `customer_user_id` = '$user_id'  AND `status` = 2 ORDER BY `cab_type` DESC ";
                
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }
// ############################# Allride ADMIN FILTER


        function filterAdmin($selected,$con){
           
            $data =array();

            if($selected == "last 7 days"){
                $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                       
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "last 30 days"){
                $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedMicro"){
                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected'";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedMini"){
                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected'";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedRoyal"){
                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected'";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            elseif($selected == "CedSUV"){
                $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected'";
                
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }


        }

        function sortAdmin($sort,$con){
           
            $data =array();

            
            if($sort == "ascending"){
                
                $sql = "SELECT * from `tbl_ride` ORDER BY `ride_date` ASC ";
               
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_ride` ORDER BY `ride_date` DESC ";
                
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        function fareAdmin($sort,$con){
           
            $data =array();

            if($sort == "asc"){
                
                $sql = "SELECT * from `tbl_ride` ORDER BY `total_fare` ASC ";
               
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_ride` ORDER BY `total_fare` DESC ";
                
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        function cabtypeAdmin($sort,$con){
           
            $data =array();

            if($sort == "cab asc"){
                
                $sql = "SELECT * from `tbl_ride` ORDER BY `cab_type` ASC ";
               
            
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_ride` ORDER BY `cab_type` DESC ";
                
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        // print_r( $row);
                        // echo "</br>";
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }


// *************************** completeRide Admin filter

function filtercompleteAdmin($selected,$con){
           
    $data =array();

    if($selected == "last 7 days"){
        $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND `status` = 2";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
               
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "last 30 days"){
        $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND `status` = 2";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "CedMicro"){
        $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `status` = 2";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "CedMini"){
        $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `status` = 2";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "CedRoyal"){
        $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `status` = 2";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "CedSUV"){
        $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `status` = 2";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }


}

function sortcompleteAdmin($sort,$con){
   
    $data =array();

    
    if($sort == "ascending"){
        
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 2 ORDER BY `ride_date` ASC ";
       
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    else{
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 2 ORDER BY `ride_date` DESC ";
        
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }

}

function farecompleteAdmin($sort,$con){
   
    $data =array();

    if($sort == "asc"){
        
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 2 ORDER BY `total_fare` ASC ";
       
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    else{
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 2 ORDER BY `total_fare` DESC ";
        
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }

}

function cabtypecompleteAdmin($sort,$con){
   
    $data =array();

    if($sort == "cab asc"){
        
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 2 ORDER BY `cab_type` ASC ";
       
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    else{
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 2 ORDER BY `cab_type` DESC ";
        
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }

}

// *************************** pendingRide Admin filter

function filterpendingAdmin($selected,$con){
           
    $data =array();

    if($selected == "last 7 days"){
        $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND `status` = 1";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
               
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "last 30 days"){
        $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND `status` = 1";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "CedMicro"){
        $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `status` = 1";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "CedMini"){
        $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `status` = 1";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "CedRoyal"){
        $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `status` = 1";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "CedSUV"){
        $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `status` = 1";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }


}

function sortpendingAdmin($sort,$con){
   
    $data =array();

    
    if($sort == "ascending"){
        
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 1 ORDER BY `ride_date` ASC ";
       
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    else{
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 1 ORDER BY `ride_date` DESC ";
        
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }

}

function farependingAdmin($sort,$con){
   
    $data =array();

    if($sort == "asc"){
        
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 1 ORDER BY `total_fare` ASC ";
       
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    else{
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 1 ORDER BY `total_fare` DESC ";
        
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }

}

function cabtypependingAdmin($sort,$con){
   
    $data =array();

    if($sort == "cab asc"){
        
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 1 ORDER BY `cab_type` ASC ";
       
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    else{
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 1 ORDER BY `cab_type` DESC ";
        
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }

}
// *************************** cancelledRide Admin filter

function filtercancelAdmin($selected,$con){
           
    $data =array();

    if($selected == "last 7 days"){
        $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND `status` = 0";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
               
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "last 30 days"){
        $sql = "SELECT * from `tbl_ride` WHERE  `ride_date` >= DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND `status` = 0";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "CedMicro"){
        $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `status` = 0";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "CedMini"){
        $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `status` = 0";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "CedRoyal"){
        $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `status` = 0";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    elseif($selected == "CedSUV"){
        $sql = "SELECT * from `tbl_ride` WHERE  `cab_type` =  '$selected' AND `status` = 0";
        
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }


}

function sortcancelAdmin($sort,$con){
   
    $data =array();

    
    if($sort == "ascending"){
        
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 0 ORDER BY `ride_date` ASC ";
       
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    else{
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 0 ORDER BY `ride_date` DESC ";
        
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }

}

function farecancelAdmin($sort,$con){
   
    $data =array();

    if($sort == "asc"){
        
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 0 ORDER BY `total_fare` ASC ";
       
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    else{
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 0 ORDER BY `total_fare` DESC ";
        
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }

}

function cabtypecancelAdmin($sort,$con){
   
    $data =array();

    if($sort == "cab asc"){
        
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 0 ORDER BY `cab_type` ASC ";
       
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }
    else{
        $sql = "SELECT * from `tbl_ride` WHERE `status` = 0 ORDER BY `cab_type` DESC ";
        
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                // print_r( $row);
                // echo "</br>";
                $data[] = $row;
            }
            return $data;
        }
    }

}
        


}
?>