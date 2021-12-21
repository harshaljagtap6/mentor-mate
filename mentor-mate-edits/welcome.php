<?php
// Include config file
require_once "config.php";

// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

$college_id = "";

if (isset($_SESSION["college_id"])) {
    $college_id = $_SESSION['college_id'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href='http://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="welcome_style.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-inverse" id="navigation_bar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="home_page.php">MentorMate</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="welcome.php">Home</a></li>
                <li><a href="home_page.php #support_start">Support</a></li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Appointment<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="book_appointment.php">Book An Appointment</a></li>
                        <li><a href="check_appointment_student.php">Check Pending Appointments</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Quiz<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="total_quiz.php">Solve quiz</a></li>
                        <li><a href="check_quiz_results_student.php">Check quiz score</a></li>
                    </ul>
                </li>

            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php" id="nav-r-btn"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                <li><a href="reset-password.php" id="nav-r-btn"><span class="glyphicon glyphicon-asterisk"></span> Reset Password</a></li>
                <li><a href="reset-password.php" id="hamburger"><span class="glyphicon glyphicon-menu-hamburger"></span></a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="float_left">
            <p>Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?> Welcome.</p>
        </div>
        <div class="float_right">
            <button id="button_right">Ask a question </button>
        </div>
        <br>
        <br>
        <h1>Most recent questions</h1>
        <br><br><br>


        <?php
        //$sql1 = "DELETE FROM `questions` WHERE CURRENT_DATE >= created_at + 7";            
        //mysqli_query($link, $sql1);
        //$sql2 = "SELECT * FROM questions ORDER BY (created_at) DESC ";
        $sql2 = "SELECT * FROM questions WHERE college_id = '".$_SESSION["college_id"]. "' ORDER BY (created_at) DESC ;";
        $result = mysqli_query($link, $sql2);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="maman">' . $row['username'] . '<br>';
                echo '<span id="created_at">' . $row['created_at'] . '</span>';
                echo '<br>';
                echo '<br><span id="heading_style">' . $row['questions_heading'] . '</span><br>';
                echo '<br>';
                echo '' . $row['questions'] . '<br><br>';

                if ($row['answer'] != NULL) {
                    echo 'Answer:<br><br>';
                    echo '' . $row['answer'] . '<br>';
                } else {
                    echo 'Your question has not been answered yet.';
                }
                echo '</div>';
                echo '<br>';
            }
        }
        ?>


    </div>
</body>

<script>
    var btn = document.getElementById('button_right');
    btn.addEventListener('click', function() {
        document.location.href = 'ask_question.php';
    });
</script>

<?php
mysqli_close($link);
?>

</html>