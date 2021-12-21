<?php

    require_once "config.php";

    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: mentor_login.php");
        exit;
    }

    $question_id_data = $_GET['question_id_data'];

    $sql = "delete from questions where id = '$question_id_data'";
    
    if (mysqli_query($link, $sql))
    {
        echo "<script> window.alert('Qustion Deleted');
        window.location.href='mentor_welcome.php';</script>";
    }
?>