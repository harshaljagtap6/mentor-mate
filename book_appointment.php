<?php
// Include config file
require_once "config.php";

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Define variables and initialize with empty values
$note_data = $note_data_err = "";
$mentor_select = $mentor_select_err = "";
$appointment_status = 0;
$college_id = $_SESSION['college_id'];
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate question body
    if(empty(trim($_POST["note_data"])))
    {
        $note_data_err = "Please enter a note";     
    } else
    {
        $note_data = trim($_POST["note_data"]);
    }

    // Validate question heading
    if(empty(trim($_POST["mentor_select"]))){
        $mentor_select_err = "Please select a mentor.";     
    } else{
        $mentor_select = trim($_POST["mentor_select"]);
    }
    
    // Check input errors before inserting in database
    if(empty($question_body_err) && empty($question_heading_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO appointment (student_user, mentor_user, note, appointment_status) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_username, $param_mentor_select, $param_note_data, $param_appointment_status);
            
            // Set parameters
            $param_username = $username = $_SESSION["username"];
            $param_mentor_select = $mentor_select;
            $param_note_data = $note_data;
            $param_appointment_status = $appointment_status;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: welcome.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    //print($question_body);
    
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="book_appointment.css">
    <link href='http://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' type='text/css'>

</head>
<body>
<nav class="navbar navbar-inverse" id="navigation_bar">
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="maman">
            <form action="book_appointment.php" method="post">
                <p>Please select your desired mentor</p><br><br>
                <select name="mentor_select" id="mentor_select">
                    <?php
                        $sql2 = "SELECT * FROM mentor_users where college_id = '$college_id' ORDER BY (username)";
                        $result = mysqli_query($link, $sql2);
                        if (mysqli_num_rows($result)>0){
                            while ($row = mysqli_fetch_array($result)){
                                echo '<option value='.$row['username'].' name='.$row['username'].'>'.$row['username'].'</option>';
                            }
                        }
                    ?>
                </select>
                <br><br>
                <?php
                    echo'<p>Write a note for the mentor.</p>';
                    echo '<textarea name="note_data" id="note_textarea" cols="100" rows="4" required></textarea>';
                ?>
                <br><br>
                <input type="Submit" value="Submit" id="edit_button">
            </form>
        </div>
    </form>
</div>
</body>
</html>

