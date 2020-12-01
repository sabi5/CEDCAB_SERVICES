<?php
class Dbconnection {
    public $server ;
    public $username;
    public $password ;
    public $db ;
    public $con;

    function __construct(){
        $this->con = new mysqli('localhost', 'root', '', 'cedcab');
        
        if ($this->con) {
            // echo "<script>alert('Connection Successful');</script>";
        } else {
            echo "<script>alert('No Connection');</script>";
            die("no connection" . mysqli_connect_error());
        }
    }
}
?>