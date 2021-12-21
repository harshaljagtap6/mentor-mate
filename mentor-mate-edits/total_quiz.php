<?php
require_once "config.php";

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$username = $_SESSION['username'];
$college_id = $_SESSION['college_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>mentor_loggedin</title>
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

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Quiz<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="check_quiz_results_student.php">Check Quiz score</a></li>
                    </ul>
                </li>
                

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
                <th>Quiz_by</th>
                <th></th>
            </tr>

            <?php

            $sql3 = "SELECT * FROM `quiz` WHERE `quiz_id` NOT IN (select `quiz_id` from `quiz_solved` where `username` = '$username') AND `college_id` = '$college_id' ; ";
            $result3 = mysqli_query($link, $sql3);
            //echo mysqli_num_rows($result3);
            if (mysqli_num_rows($result3) > 0) {
                while ($row3 = mysqli_fetch_array($result3)) {
                    echo '<tr>';
                    echo '<td>' . $row3['quiz_id'] . '</td>';
                    echo '<td>' . $row3['quiz_subject'] . '</td>';
                    echo '<td>' . $row3['quiz_name'] . '</td>';
                    echo '<td>' . $row3['quiz_by'] . '</td>';
                    //$quiz_name = $row3['quiz_name'];
                    echo '<td><a id=answer_button href="solve_quiz.php?quiz_name='.$row3['quiz_name'].'&quiz_subject='.$row3['quiz_subject'].'&quiz_id='.$row3['quiz_id'].'&total='.$row3['total_questions'].'&quiz_by='.$row3['quiz_by'].'">Solve</a></td>';
                    //echo '<a href = "answer_here.php?question_id_data=' . $row3['id'] . '">';
                    echo '</tr>';
                }
            }
            elseif (mysqli_num_rows($result3) == 0)
            {
                echo '<tr>';
                echo '<td colspan="5"><p>No Pending Quiz</p></td>';
                echo '</tr>';
            }

            ?>
        </table>
    </div>
</body>

</html>