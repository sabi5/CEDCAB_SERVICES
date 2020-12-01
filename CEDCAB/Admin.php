<?php 
    class Admin {

        public $con;
        function user ($con){
            
            $data =array();
            
            $sql = "SELECT * FROM `tbl_user`";
        
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
            // echo $sql1;
        
            $query1 = $con->query($sql1);
            // echo $query1;
            
            if ($query1->num_rows > 0) {

                while($row = $query1->fetch_assoc()){
                    $pending[] = $row;
                }
                return $pending;
            }
        }
        function approvedUser ($con){
            
            $data =array();
            
            $sql = "SELECT * FROM `tbl_user` WHERE `isblock` ='1'";
        
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
    
            // $id = $_SESSION['user']['id'];
        
            $data =array();
            
            $sql = "SELECT * FROM `tbl_ride` WHERE `status` = '1'";
        
            $query = $con->query($sql);
        
            $count = $query->num_rows;
            
            return $count;
        
        }

        function pendingUsers($con){
    
            // $id = $_SESSION['user']['id'];
        
            $data =array();
            
            $sql = "SELECT * FROM `tbl_user` WHERE `isblock` = '0'";
        
            $query = $con->query($sql);
        
            $count = $query->num_rows;
           
            return $count;
        
        }
        
    }
?>