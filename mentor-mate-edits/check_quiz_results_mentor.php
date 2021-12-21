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

$username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>student_loggedin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="total_style.css">
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
                <li><a href="welcome.php">Home</a></li>
                <li><a href="home_page.php #support_start">Support</a></li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Appointment<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <!--<li><a href="book_appointment.php">Book An Appointment</a></li>-->
                        <li><a href="check_appointment.php">Check Pending Appointments</a></li>
                    </ul>
                </li>

                <!--<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Quiz<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="check_quiz_score.php">Check Quiz score</a></li>
                    </ul>
                </li>-->


            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                <li><a href="reset-password.php"><span class="glyphicon glyphicon-asterisk"></span> Reset Password</a></li>
            </ul>
        </div>
    </nav>
    <div class="container maman">
        <table>
            <tr>
                <th>Quiz_id</th>
                <th>Quiz_subject</th>
                <th>Quiz_name</th>
                <th>Marks</th>
                <th>Solved by</th>
            </tr>

            <?php
            $suername = $_SESSION['username'];
            //$sql3 = "SELECT * FROM quiz ORDER BY (created_at) DESC ";
            $sql3 = "SELECT * FROM `quiz_results` where `quiz_by` = '$username';";
            $result3 = mysqli_query($link, $sql3);
            //echo mysqli_num_rows($result3);
            if (mysqli_num_rows($result3) > 0) {
                while ($row3 = mysqli_fetch_array($result3)) {
                    echo '<tr>';
                    echo '<td>' . $row3['quiz_id'] . '</td>';
                    echo '<td>' . $row3['quiz_subject'] . '</td>';
                    echo '<td>' . $row3['quiz_name'] . '</td>';
                    echo '<td>' . $row3['correct_answers'] . '/' . $row3['total_questions'] . '</td>';
                    echo '<td>' . $row3['student_username'] . '</td>';
                    //$quiz_name = $row3['quiz_name'];
                    //echo '<td><a href="solve_quiz.php?quiz_name=' . $row3['quiz_name'] . '&quiz_subject=' . $row3['quiz_subject'] . '&quiz_id=' . $row3['quiz_id'] . '&total=' . $row3['total_questions'] . '">Solve</a></td>';
                    //echo '<a href = "answer_here.php?question_id_data=' . $row3['id'] . '">';
                    echo '</tr>';
                }
            } elseif (mysqli_num_rows($result3) == 0) {
                echo '</table>';
                echo 'No quiz solved';
            }

            ?>
        </table>
    </div>

</body>

<?php

/*$sql="SELECT `quiz_name`, `quiz_subject`, `correct_answers`, `total_questions` FROM `quiz_results` where `student_username` = '$username';";
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_array($result))
    {
        echo $row['quiz_name'];
    }
}*/

?>