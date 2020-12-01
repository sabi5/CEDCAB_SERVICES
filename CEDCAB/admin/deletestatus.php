<?php
    require "../Dbconnection.php";
    $Connection = new Dbconnection();
    $conn = $Connection->con;

    $id = $_GET['id'];
    $q = "DELETE FROM `tbl_ride` WHERE `ride_id` = '$id'";
    mysqli_query($conn, $q);
    echo '<script>alert("Account deleted Successfully")</script>';
?>
<script>location.replace("admin.php")</script>
