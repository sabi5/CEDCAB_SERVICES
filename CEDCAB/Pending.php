<?php

class Pending{
    public $con;
    
    function pendingUser ($con){
            
        $pending =array();
        
        $sql = "SELECT * FROM `tbl_user` WHERE `isblock` = `0`";
        echo $sql;
    
        $query = $con->query($sql);
        echo $query;
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                $pending[] = $row;
            }
            return $pending;
        }
    }
    function approvedUser ($con){
        
        $data =array();
        
        $sql = "SELECT * FROM `tbl_user` WHERE `isblock` = `1`";
    
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