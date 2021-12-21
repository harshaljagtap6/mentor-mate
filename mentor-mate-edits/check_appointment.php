<?php
// Include config file
require_once "config.php";

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>mentor_loggedin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="check_appointment_style.css">
    <link href='http://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
<div class="container-fluid">
    <div class="navbar-header">
    <a class="navbar-brand" href="home_page.php">MentorMate</a>
    </div>
    <ul class="nav navbar-nav">
        <li ><a href="home_page.php">Home</a></li>
        <li ><a href="home_page.php #support_start">Support</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        <li><a href="reset-password.php"><span class="glyphicon glyphicon-asterisk"></span> Reset Password</a></li>
    </ul>
</div>
</nav>
<div class="container">
    <div class="page-header">
        <h1>Hi, <strong><?php echo htmlspecialchars($_SESSION["username"]); ?></strong>. Welcome to our site.</h1>
    </div>

    <?php
        $loggedin_username = $_SESSION['username'];
        $sql = "SELECT * FROM appointment WHERE mentor_user =  '$loggedin_username' AND appointment_status = '0'";
        $result = mysqli_query($link, $sql);
        //echo mysqli_num_rows($result);
        if (mysqli_num_rows($result) > 0)
        {
            while ($row = mysqli_fetch_array($result))
            {
                if ($row["appointment_status"] == 0)
                {
                    echo '<div class="maman">';
                    echo 'Appointment requested by : '.$row["student_user"].'<br><br>';
                    echo 'On : '.$row["created_at"].'<br><br>';
                    echo 'Note : '.$row["note"].'<br><br>';
                    echo '<a href="accept_appointment.php?appointment_id='.$row['appointment_id'].'">';
                    echo '<input type = "button" id = "accept_button" value = "Accept" >';
                    echo '</a>';
                    echo '<a href="decline_appointment.php?appointment_id='.$row['appointment_id'].'">';
                    echo '<input type = "button" id = "decline_button" value = "Decline" >';
                    echo '</a>';
                    echo '</div>';
                    echo '<br>';
                }
            }
        }
        else 
        {
            echo '<div class="maman">';
            echo 'No pending requests found';
            echo '</div>';
            echo '<br>';
        }
    ?>  
</div>
</body>
</html>