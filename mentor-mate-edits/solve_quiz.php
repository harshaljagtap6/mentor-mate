<?php

    require_once "config.php";

    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }

    //$quiz_id = $_GET['quiz_id'];
    if ( (isset($_GET['quiz_subject'])) && (isset($_GET['quiz_name'])) && (isset($_GET['total'])) && (isset($_GET['quiz_id'])) && (isset($_GET['quiz_by'])) )
    {   
        $quiz_subject = $_GET['quiz_subject'];
        $quiz_name = $_GET['quiz_name'];
        $total_questions = $_GET['total'];
        $quiz_id = $_GET['quiz_id'];
        $quiz_by = $_GET['quiz_by'];
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>mentor_loggedin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="solve_quiz_style.css">
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
    <?php
    $sql = "SELECT * FROM quiz_questions WHERE quiz_subject = '$quiz_subject' AND quiz_name = '$quiz_name' AND quiz_id = $quiz_id ORDER BY (question_id) ";
    echo '<form action="solve_quiz_action.php" method="post">';
    echo '<input type="text" hidden name="quiz_name" value="'.$quiz_name.'">';
    echo '<input type="text" hidden name="quiz_subject" value="'.$quiz_subject.'">';
    echo '<input type="text" hidden name="total_questions" value="'.$total_questions.'">';
    echo '<input type="text" hidden name="quiz_id" value="'.$quiz_id.'">';
    echo '<input type="text" hidden name="quiz_by" value="'.$quiz_by.'">';
    echo '<input type="text" hidden name="username" value="'.$_SESSION['username'].'">';
    echo '<div class="container">';
    $result = mysqli_query($link, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo '
                <div class="form-group maman"> 
                <input type="text" hidden name="question_'.$row['question_id'].'" value="'.$row['question'].'" />
                <ul>
                <li>
                '.$row['question'].'
                <br><br>
                </li>
                <li>
                &nbsp&nbsp&nbsp&nbspOption A:&nbsp&nbsp
                <input type="radio" name="option_'.$row['question_id'].'" value="option_a" />'.$row['option_a'].'
                </li>
                <li>
                &nbsp&nbsp&nbsp&nbspOption B:&nbsp&nbsp
                <input type="radio" name="option_'.$row['question_id'].'" value="option_b" />'.$row['option_b'].'
                </li>
                <li>
                &nbsp&nbsp&nbsp&nbspOption C:&nbsp&nbsp
                <input type="radio" name="option_'.$row['question_id'].'" value="option_c" />'.$row['option_c'].'
                </li>
                <li>
                &nbsp&nbsp&nbsp&nbspOption D:&nbsp&nbsp
                <input type="radio" name="option_'.$row['question_id'].'" value="option_d" />'.$row['option_d'].'
                </li>
                </ul>
                </div>'
            ;

        }
    }
    echo '<input type="submit" value="Submit" id="button_right"><br><br>';
    echo '</form>';
    echo '</div>';
?>