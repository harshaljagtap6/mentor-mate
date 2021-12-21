<?php

require_once "config.php";

$total = $_POST['total'];
$quiz_name = $_POST['quiz_name'];
$quiz_subject = $_POST['quiz_subject'];
$quiz_id = $_POST['quiz_id'];
$quiz_by = $_POST['quiz_by'];
$data = $_POST;

echo "<pre>";

$count = count($_POST['question']);

for ($i=0; $i<$total; $i++)
{
    $sql = "INSERT INTO `quiz_questions` (`quiz_by`, `quiz_id`, `quiz_name`, `quiz_subject` ,`question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer` ,`question_id`) VALUES ('$quiz_by', '$quiz_id', '$quiz_name', '$quiz_subject', '{$_POST['question'][$i]}', '{$_POST['option_A'][$i]}', '{$_POST['option_B'][$i]}', '{$_POST['option_C'][$i]}', '{$_POST['option_D'][$i]}','{$_POST['selects'][$i]}' ,'$i')";
    if (mysqli_query($link, $sql))
    {
        echo ' <script>
        alert("Quiz uploaded");
        </script>';
        header("Location: mentor_welcome.php");
    }
    else
    {
        echo ' <script>
        alert("Something went wrong");
        </script>';
        echo'<script>
        alert("Answers submitted");  
        window.location.href=mentor_welcome.php"
    </script>
';
    }
}

?>