<?php
 
    session_start();

    require "../Dbconnection.php";
    require "../Location.php";

    if (isset($_POST['submit'])) {
        $name =  $_POST['name'];
        $distance = $_POST['distance'];
        
        $locate = new Location();
        $Connection = new Dbconnection();

        $sql = $locate->addLocation($name, $distance, $Connection->con);
        echo $sql;

    }
    if (!isset($_SESSION['user']['username'])) {     
        echo '<script>alert("You are logged out")</script>';
       ?>
       <script>location.replace("../login.php")</script> 
        <?php
    }
    ?>
?> 
<html>
    <head>
        <title>Add Location</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
       
    </head>
    <body>
        <div id="wrapper">
            <div class="container form">
                <h2>ADD LOCATION</h2><br>
                <form action="addLocation.php" method="POST">
                    <p>
                        <label for="name">Location : <input type="text" 
                         name="name" required></label>
                    </p>
                    <p>
                        <label for="distance">Distance : <input type="number" 
                        name="distance" required></label>
                    </p>
                    <p>
                        <input class="btn btn-success" type="submit" name="submit" value="Submit">
                    </p>
                    
                </form>
                <a href="admin.php"><button class="btn btn-primary">DASHBOARD</button> </a>
            </div>
        </div>
    </body>
</html>
