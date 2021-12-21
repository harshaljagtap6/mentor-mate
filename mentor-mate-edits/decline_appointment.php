<?php

    require_once "config.php";

    session_start();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: mentor_login.php");
        exit;
    }

    $appointment_id = $_GET['appointment_id'];

    $sql = "update appointment set appointment_status = 1, appointment_declined = 1 where appointment_id = '$appointment_id'";

    if (mysqli_query($link, $sql))
    {
        echo "<script> window.alert('Appointment Declined');
        window.location.href='mentor_welcome.php';</script>";
    }
?>