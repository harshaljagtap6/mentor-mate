<?php

include 'config.php';

session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
} 
 
$question_body = $question_heading = $loggedin_username = '';

$question_heading = $_POST['question_heading'];
$question_body = $_POST['question_body'];
$username = $_SESSION['username'];

// Escape user inputs for security
$question_heading = mysqli_real_escape_string($link, $_POST['question_heading']);
$question_body = mysqli_real_escape_string($link, $_POST['question_body']);

 
// Attempt insert query execution
$sql = "INSERT INTO questions (username, questions, questions_heading) VALUES ('$username','$question_body', '$question_heading')";
if(mysqli_query($link, $sql)){
    echo 'it is not working';
    echo '<script type="text/javascript">alert("Question Posted Successfully");</script>';
    echo 'did it work?';
    header("location: welcome.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>