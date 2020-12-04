<?php 
    class Location{

        public $con;
        function place($con){
            
            $data =array();
            
            $sql = "SELECT * FROM `tbl_location`";
        
            $query = $con->query($sql);
            
            if ($query->num_rows > 0) {

                while($row = $query->fetch_assoc()){
                    $data[] = $row;
                }
                return $data;
            }
        }
        function addLocation ($name, $distance, $con){
            
            if (isset($_POST['submit'])) {
        
                $sql = "SELECT * FROM `tbl_location` WHERE `name` ='$name'";
                $query = mysqli_query($con, $sql);
            
                $namecount = mysqli_num_rows($query);
            
                if ($namecount > 0) {
                    echo("<script>alert('Location already exists');</script>");
                } else {
            
                    if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $name)) {
                        echo("<script>alert('Please insert valid location');</script>");
                    } else {
                    
                    
                        $insertquery = "INSERT INTO `tbl_location` (name, distance, is_available) 
                                VALUES ('$name', '$distance', '1')";
            
                        $iquery = mysqli_query($con, $insertquery);
                        
                        if ($iquery) {
                            echo "<script>alert('Inserted Successful');</script>";
                        } else {
                            echo "<script>alert('Not inserted');</script>";
                        }
                    }
                    
                }
            }
        }
    }
?>