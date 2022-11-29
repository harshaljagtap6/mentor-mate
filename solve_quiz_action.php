<?php

require_once "config.php";

if (isset($_POST['total_questions']))
{
 $total_questions = $_POST['total_questions'];
}
//echo $total_questions;
if (isset($_POST['quiz_name']))
{
 $quiz_name = $_POST['quiz_name'];
}

if (isset($_POST['quiz_subject']))
{
    $quiz_subject = $_POST['quiz_subject'];
}

if (isset($_POST['username']))
{
    $username = $_POST['username'];
}

if (isset($_POST['quiz_id']))
{
    $quiz_id = $_POST['quiz_id'];
}

if (isset($_POST['quiz_by']))
{
    $quiz_by = $_POST['quiz_by'];
}

$data = $_POST;


/*echo "<pre>";
//var_dump($data);
echo '<br><br>';*/

//$count = count($_POST['question']);
//'{$_POST['option_'.$i.''][$i]}'
for ($i=0; $i<$total_questions; $i++)
{
    $sql = "INSERT INTO `student_solve_quiz` (`quiz_by`, `quiz_id`, `quiz_name`, `quiz_subject`, `question`, `answer`, `question_id`, `username`) VALUES ('$quiz_by', '$quiz_id', '$quiz_name', '$quiz_subject', '{$_POST['question_'.$i.'']}', '{$_POST['option_'.$i.'']}', '$i', '$username')";
    //INSERT INTO `student_solve_quiz` (`quiz_name`, `quiz_subject`, `question`, `answer`, `question_id`) VALUES ('', '', '', '', '');
    /*if (*/mysqli_query($link, $sql);/*)
    {
        echo 'inserted<br><br>';
    }
    else
    {
        echo 'something went wrong1<br><br>';
    }*/

    /*if (mysqli_query($link, $sql))
    {
        echo 'Something went wrong';
    }
    else
    {
        echo ' <script>
        alert("Quiz uploaded");
        </script>';
        header("Location: mentor_welcome.php");
    }*/
}

$correct = 0;
$incorrect = 0;

$sql2 = "SELECT answer, question_id FROM `student_solve_quiz` WHERE
    answer IN (SELECT `answer` from `quiz_questions` where `quiz_name` = '$quiz_name' AND `quiz_subject` = '$quiz_subject') AND
    `quiz_name` = '$quiz_name' AND 
    `quiz_subject` = '$quiz_subject' AND
    `username` = '$username' AND
    `quiz_id` = '$quiz_id'; ";
    $result2 = mysqli_query($link, $sql2);
    /*echo 'numrows_correct:-';
    echo mysqli_num_rows($result2);
    echo 'xx<br><br>';*/

if (mysqli_num_rows($result2) > 0) {
    $correct = mysqli_num_rows($result2);
}



$sql3 = "SELECT answer, question_id FROM `student_solve_quiz` WHERE
    answer NOT IN (SELECT `answer` from `quiz_questions` where `quiz_name` = '$quiz_name' AND `quiz_subject` = '$quiz_subject') AND
    `quiz_name` = '$quiz_name' AND 
    `quiz_subject` = '$quiz_subject' AND
    `username` = '$username' AND
    `quiz_id` = '$quiz_id'; ";
    $result3 = mysqli_query($link, $sql3);
    /*echo 'numrows_incorrect:-';
    echo mysqli_num_rows($result3);
    echo 'xx<br><br>';*/

if (mysqli_num_rows($result3) > 0) {
    $incorrect = mysqli_num_rows($result3);
}


/*echo '$correct=';
echo $correct;
echo '<br><br>$incorrect=';
echo $incorrect;*/
$sql4 = "INSERT INTO `quiz_results` (`quiz_by`, `quiz_id`,`quiz_name`, `quiz_subject`, `correct_answers`, `incorrect_answers`, `total_questions`, `student_username`) VALUES ('$quiz_by', '$quiz_id', '$quiz_name', '$quiz_subject', '$correct', '$incorrect', '$total_questions', '$username');";
mysqli_query($link, $sql4);

$sql5 = "INSERT INTO `quiz_solved` (`quiz_by`, `quiz_id`, `quiz_name`,`quiz_subject`,`solved`,`username`) VALUES ('$quiz_by', '$quiz_id', '$quiz_name','$quiz_subject','1','$username')";
mysqli_query($link, $sql5);



echo'<script>
        alert("Answers submitted");  
    </script>
';

header("Location: welcome.php");


?>