<?php 
    class Admin {

        public $con;
        function user ($con){
        
            $data =array();
            $sql = "SELECT * FROM `tbl_user` WHERE `is_admin` = '0'";
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }
        
        function pendingUser ($con){
            
            $pending =array();
            $sql1 = "SELECT * FROM `tbl_user` WHERE `isblock` = '0'";
            $query1 = $con->query($sql1);
         
            if ($query1->num_rows > 0) {

                while($row = $query1->fetch_assoc()){
                    $pending[] = $row;
                }
                return $pending;
            }
        }
        function approvedUser ($con){
            
            $data =array();
            $sql = "SELECT * FROM `tbl_user` WHERE `isblock` ='1' AND `is_admin` = '0'";
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }
        function pendingRide ($con){
            
            $data =array();
            $sql = "SELECT * FROM `tbl_ride` WHERE `status` ='1'";
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }
        function completeRide ($con){
            
            $data =array();
            $sql = "SELECT * FROM `tbl_ride` WHERE `status` ='2'";
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }
        function cancelRide ($con){
            
            $data =array();
            $sql = "SELECT * FROM `tbl_ride` WHERE `status` ='0'";
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }
        function allRide ($con){
            
            $data =array();
            $sql = "SELECT * FROM `tbl_ride`";
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }
// ****************************
        
        function totalEarn($con){
        
            $data =array();
            $sql = "SELECT * FROM `tbl_ride`";
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {
    
                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }

        function totalRides($con){
        
            $data =array();
            $sql = "SELECT * FROM `tbl_ride`";
            $query = $con->query($sql);

            $count = $query->num_rows;
            return $count;
        
        }
        
        function pendingRides($con){
    
            $data =array();
            $sql = "SELECT * FROM `tbl_ride` WHERE `status` = '1'";
            $query = $con->query($sql);
        
            $count = $query->num_rows;
            return $count;
        }

        function pendingUsers($con){
    
            $data =array();
            $sql = "SELECT * FROM `tbl_user` WHERE `isblock` = '0'";
            $query = $con->query($sql);
        
            $count = $query->num_rows;
           
            return $count;
        
        }

        // ############################# ADMIN USER FILTER

        function sortDate($sort,$con){
           
            $data =array();
            if($sort == "ascending"){
                
                $sql = "SELECT * from `tbl_user` ORDER BY `dateofsignup` ASC ";
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_user` ORDER BY `dateofsignup` DESC ";
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {
                    while($row = $query->fetch_assoc()){
                        
                        $data[] = $row;
                    }
                    return $data;
                }
            }

        }

        function sortName($sort,$con){
           
            $data =array();

            if($sort == "asc"){
                
                $sql = "SELECT * from `tbl_user` ORDER BY `username` ASC ";
                $query = $con->query($sql);
                
                if ($query->num_rows > 0) {

                    while($row = $query->fetch_assoc()){
                       
                        $data[] = $row;
                    }
                    return $data;
                }
            }
            else{
                $sql = "SELECT * from `tbl_user` ORDER BY `username` DESC ";
                
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

        function pendingLast ($con){
            
            $data =array();
            
            $sql = "SELECT * FROM `tbl_ride` WHERE `status` ='1' ORDER BY `status` DESC LIMIT 1";
        
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }
    }
?>