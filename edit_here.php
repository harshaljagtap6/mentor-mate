<?php
// Include config file
require_once "config.php";

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$q_id = $_GET['question_id_data'];
 
// Define variables and initialize with empty values
$answer_data = "";
$answer_data_err = "";
$question_id = "";
$question_id_err = "";
$question_id_data = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate question body
    if(empty(trim(isset($_POST["answer_data"]))))
    {
        $answer_data_err = "Please enter answer";     
    } else
    {
        $answer_data = trim($_POST["answer_data"]);
    }
    
    if(empty(trim(isset($_POST["q_id"]))))
    {
        $question_id_err = "Please enter answer";     
    } else
    {
        $question_id_data = trim($_POST["q_id"]);
    }  
    // Check input errors before inserting in database
    if(empty($answer_data_err)){
        
        // Prepare an insert statement
        echo $question_id_data;
        $sql = "update questions set answer = (?) where id = ?";
        //INSERT INTO Student SELECT * FROM LateralStudent WHERE Age = 18;
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_answer_data, $param_question_id_data);
            
            // Set parameters
            $param_answer_data = $answer_data;
            $param_question_id_data = $question_id_data;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: mentor_welcome.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
            echo 'walla';
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>mentor_loggedin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href='//fonts.googleapis.com/css?family=Poppins' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="mentor_welcome_style.css">
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
                <li><a href="mentor_welcome.php">Home</a></li>
                <li><a href="home_page.php #support_start">Support</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                <li><a href="reset-password.php"><span class="glyphicon glyphicon-asterisk"></span> Reset Password</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
    <?php
        $sql = "SELECT * FROM questions WHERE id=$q_id ";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="maman">' . $row['username'] . '<br>';
                echo '<span id="created_at">' . $row['created_at'] . '</span>';
                echo '<br>';
                echo '<b><br><span id="heading_style">' . $row['questions_heading'] . '</span><br></b>';
                echo '<br>';
    ?>
                <form action="answer_here.php" method="post">
            <?php
                echo '<input type="hidden" name="q_id" id="q_id" cols="30" rows="10" value = "' . $row['id'] . '">';
                echo '' . $row['questions'] . '<br>';
                echo '<br>';
                echo '<textarea name="answer_data" id="answer_textarea" cols="100" rows="4">'.$row['answer'].'</textarea>';
                echo '<br>';
                echo '<br>';
                echo '<input type="submit" value="Submit" class="float_left" id="answer_button">';
                echo '<i class="fa fa-trash fa-3" ></i>';
            }
        }

            ?>
    </div>

</body>

</html>