<?php
// Include config file
require_once "config.php";

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}



// Define variables and initialize with empty values
$answer_data = "";
$answer_data_err = "";
$question_id = "";
$question_id_err = "";
$question_id_data = "";
$college_id = "";

if (isset($_SESSION["college_id"])) {
    $college_id = $_SESSION['college_id'];
}

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate question body
    if (empty(trim(isset($_POST["answer_data"])))) {
        $answer_data_err = "Please enter answer";
    } else {
        $answer_data = trim($_POST["answer_data"]);
    }

    if (empty(trim(isset($_POST["q_id"])))) {
        $question_id_err = "Please enter answer";
    } else {
        $question_id_data = trim($_POST["q_id"]);
    }
    // Check input errors before inserting in database
    if (empty($answer_data_err)) {

        // Prepare an insert statement
        $sql = "update questions set answer = (?) where id = ?";
        //INSERT INTO Student SELECT * FROM LateralStudent WHERE Age = 18;
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_answer_data, $param_question_id_data);

            // Set parameters
            $param_answer_data = $answer_data;
            $param_question_id_data = $question_id_data;
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: mentor_welcome.php");
            } else {
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
    <link rel="stylesheet" href="mentor_welcome_style.css">
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
                <li><a href="mentor_welcome.php">Home</a></li>
                <li><a href="home_page.php #support_start">Support</a></li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Appointment<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <!--<li><a href="book_appointment.php">Book An Appointment</a></li>-->
                        <li><a href="check_appointment.php">Check Pending Appointments</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Quiz<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="add_quiz.php">Add a quiz</a></li>
                        <li><a href="check_quiz_results_mentor.php">Check Quiz results</a></li>
                    </ul>
                </li>
                

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
        $sql = "SELECT * FROM questions WHERE college_id = '".$_SESSION["college_id"]. "' ORDER BY (created_at) DESC ;";
        $result = mysqli_query($link, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="maman">' . $row['username'] . '<br>';
                echo '<span id="created_at">' . $row['created_at'] . '</span>';
                echo '<br>';
                echo '<b><br><span id="heading_style">' . $row['questions_heading'] . '</span><br></b>';
                echo '<br>';
        ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <?php
                    echo '<input type="hidden" name="q_id" id="q_id" cols="30" rows="10" value = "' . $row['id'] . '">';
                    echo '' . $row['questions'] . '<br>';
                    echo '<br>';

                    if ($row['answer'] != NULL) {
                        echo '<textarea name="answer_data" id="answer_textarea" cols="100" rows="4" readonly = "true" >' . $row['answer'] . '</textarea>';
                        echo '<br>';
                        echo '<br>';
                        echo '<a href = "edit_here.php?question_id_data=' . $row['id'] . '">';
                        echo '<input type="button" value="Edit" class="float_left" id="edit_button">';
                        echo '</a>';
                    } else {
                        echo '<br>';
                        echo '<br>';
                        echo '<a href = "answer_here.php?question_id_data=' . $row['id'] . '">';
                        echo '<input type="button" value="Answer" class="float_left" id="answer_button">';
                        echo '</a>';
                    }
                    echo '&nbsp&nbsp&nbsp&nbsp<a href = "delete_here.php?question_id_data=' . $row['id'] . '">';
                    echo '<input type="button" value="Delete" class="float_left" id="delete_button">';
                    echo '</a>';
                    echo '<br>';
                    ?>
                </form>
        <?php
                echo '</div>';
                echo '<br>';
            }
        }
        ?>
    </div>
</body>

</html>