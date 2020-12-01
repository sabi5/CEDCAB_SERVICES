<?php 

// session_start();
// require "Dbconnection.php";

class User {

    public $user_id;
    public $username;
    public $email;
    public $dateofsignup;
    public $mobile;
    public $isblock;
    public $password;
    public $repassword ;
    public $isadmin;
    public $con;
    

    function login ($username, $password, $checked, $con){

        $sql = "SELECT * FROM `tbl_user` where `username` = '$username'";
        
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {
            $rtn = "success";

            $username_pass = $query->fetch_assoc();
            
            $user = $username_pass['username'];
           
            setcookie('username', $user, time() + (86400 * 30), "/"); // 86400 = 1 day
               
                $db_pass = $username_pass['password'];
                $_SESSION['user'] = array('username'=>$username_pass['username'],
                            'id'=>$username_pass['user_id'], 'is_admin'=>$username_pass['is_admin'], 'isblock'=>$username_pass['isblock'], 'email'=>$username_pass['email']);   
                
                // ************* end cookies
                if ($password==$db_pass) {
                    if ($_SESSION['user']['is_admin'] == 1) {
                       echo "<script>alert('Admin login successful');</script>";
                        
                        echo  "<script>location.replace('admin/admin.php');</script>";
                    } elseif($_SESSION['user']['isblock'] == 1) {
                        echo "<script>location.replace('bookRide.php');</script>";
                    } else{
                        echo "<script>alert('Sorry! you are block by admin');</script>";
                        echo "<script>location.replace('login.php');</script>";
                    }
                    
                } else {
                    echo "<script>alert('password Incorrect');</script>";
                }
        
            } else {
                echo "<script>alert('Invalid Username');</script>";
            }
        
    
    }

    function signup($username, $password, $repassword, $email, $mobile, $con){

        if (isset($_POST['submit'])) {
        
            $emailquery = "SELECT * FROM tbl_user WHERE email='$email'";
            $query = mysqli_query($con, $emailquery);
        
            $emailcount = mysqli_num_rows($query);
        
            if ($emailcount > 0) {
                echo("<script>alert('Email already exists');</script>");
            } else {
                if ($password === $repassword) {
                    $insertquery = "INSERT INTO tbl_user (username, email, dateofsignup, mobile, isblock, password, is_admin) 
                            VALUES ('$username', '$email', NOW(), '$mobile', 0, '$password',0)";
        
                    $iquery = mysqli_query($con, $insertquery);


                    
                    if ($iquery) {
                        echo "<script>alert('Inserted Successful');</script>";
                    } else {
                        echo "<script>alert('Not inserted');</script>";
                    }
                } else {
                    echo("<script>alert('Password not matched');</script>");
                }
            }
        }
    }

    function customerProfile($con){
         
        $name = $_SESSION['user']['username'];
       
    
        $data =array();
        
        $sql = "SELECT * FROM `tbl_user` WHERE `username`= '$name'";
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
    
    }

    function totalSpent($con){

        $id = $_SESSION['user']['id'];
        // echo $id;
    
        $data =array();
        
        $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$id'";
    
        $query = $con->query($sql);
        
        if ($query->num_rows > 0) {

            while($row = $query->fetch_assoc()){
                $data[] = $row;
            }
            return $data;
        }
    }

    function totalRides($con){

        $id = $_SESSION['user']['id'];
    
        $data =array();
        
        $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$id'";
    
        $query = $con->query($sql);
    
        $count = $query->num_rows;
        return $count;
    
    }
    
    function pendingRides($con){

        $id = $_SESSION['user']['id'];
    
        $data =array();
        
        $sql = "SELECT * FROM `tbl_ride` WHERE `customer_user_id` = '$id' AND `status` = '1'";
    
        $query = $con->query($sql);
    
        $count = $query->num_rows;
      
        return $count;
    
    }
    

}

?>