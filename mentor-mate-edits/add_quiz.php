<?php
// Include config file
require_once "config.php";

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Define variables and initialize with empty values
$quiz_name = $quiz_subject = $total_questions = "";
$quiz_name_err = $quiz_subject_err = $total_questions_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate question body
    if(empty(trim($_POST["quiz_name"])))
    {
        $quiz_name_err = "Please enter subject name";     
    } else
    {
        $quiz_name = trim($_POST["quiz_name"]);
    }

    if(empty(trim($_POST["quiz_subject"]))){
        $quiz_subject_err = "Please enter subject name.";     
    } else{
        $quiz_subject = trim($_POST["quiz_subject"]);
    }

    // Validate question heading
    if(empty(trim($_POST["total_questions"]))){
        $total_questions_err = "Please enter total_questions.";     
    } else{
        $total_questions = trim($_POST["total_questions"]);
    }
    
    // Check input errors before inserting in database
    if(empty($quiz_name_err) && empty($quiz_subject_err) && empty($total_marks_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO quiz (quiz_by, quiz_name, quiz_subject, total_questions, college_id) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssis", $param_username, $param_quiz_name, $param_quiz_subject, $param_total_questions, $paaram_college_id);
            
            // Set parameters
            $param_username = $username = $_SESSION["username"];
            $paaram_college_id = $college_id = $_SESSION["college_id"];
            $param_quiz_name = $quiz_name;
            $param_quiz_subject = $quiz_subject;
            //$param_total_marks = $total_marks;
            $param_total_questions = $total_questions;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: add_quiz_questions.php?quiz_name=".$quiz_name."&total_questions=".$total_questions."&quiz_subject=".$quiz_subject."&quiz_id=".$quiz_id."");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    //print($quiz_name);
    
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
            <li ><a href="#">Book An Appointmeet</a></li>
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
            Enter quiz name:
            <input type="text" name="quiz_name" required><br><br>
            Enter subject name:
            <input type="text" name="quiz_subject" required><br><br>
            Enter total questions: 
            <input type="number" name="total_questions" required><br><br>
            <input type="submit" id="edit_button">
        </div>
    </form>
</div>
</body>
</html>