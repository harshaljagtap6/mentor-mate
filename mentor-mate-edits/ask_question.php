<?php
// Include config file
require_once "config.php";

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
 
// Define variables and initialize with empty values
$question_body = $question_heading = "";
$question_body_err = $question_heading_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate question body
    if(empty(trim($_POST["question_body"])))
    {
        $question_body_err = "Please enter question body";     
    } else
    {
        $question_body = trim($_POST["question_body"]);
    }

    // Validate question heading
    if(empty(trim($_POST["question_heading"]))){
        $question_heading_err = "Please enter question heading.";     
    } else{
        $question_heading = trim($_POST["question_heading"]);
    }
    
    // Check input errors before inserting in database
    if(empty($question_body_err) && empty($question_heading_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO questions (username, questions, questions_heading, college_id) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_username, $param_question_body, $param_question_heading, $param_college_id);
            
            // Set parameters
            $param_username = $username = $_SESSION["username"];
            $param_college_id = $college_id = $_SESSION["college_id"];
            $param_question_body = $question_body;
            $param_question_heading = $question_heading;
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
    <link rel="stylesheet" href="ask_question.css">
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
            <li ><a href="book_appointment">Book An Appointmet</a></li>
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
            <p><b>Question Heading</b></p><br>
            <p>Be specific in fewer words. </p><br>
            <textarea name="question_heading" class="question_heading" id="" maxlength="150" placeholder="Give your question a simple heading." cols="30" rows="10"></textarea>
            <br><br><br><br>
            <p><b>Problem</b></p><br>   
            <p>State your problem here</p><br>
            <textarea name="question_body" class="question_body" id="" maxlength="3000" placeholder="State your problem here"></textarea><br><br>
            <input type="submit" id="edit_button">
        </div>
    </form>
</div>
</body>
</html>

