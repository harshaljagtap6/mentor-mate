<?php
        // Include config file
        require_once "config.php";    

        // Initialize the session
        session_start();

        // Check if the user is logged in, if not then redirect him to login page
        if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
            header("location: login.php");
            exit;
        }
        else{
            
        }


        // Closing mysql connection
        
?>
<?php

$sql = "select * from questions;";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_array($result)){
    echo '<div class="maman">'.$row['questions'].'</div>';
}
?>
<?php
    mysqli_close($link);
    ?>