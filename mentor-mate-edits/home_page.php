<?php

    // Include Config Files
    require_once "config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="home_page_style.css">
    <link href='http://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' type='text/css'>
</head>
<body>
    <nav class="navigation_bar">
        <ul>
            <li><a href="home_page.php">Home</a></li>
            <li><a href="#support_start">Support</a></li>
            <button type="Submit" class="nav_login" id="nav_bar_btn_m">Login As Mentor</button>
            <button type="Submit" class="nav_login" id="nav_bar_btn_s">Login As Student</button>
        </ul>
    </nav>
    <div class="home_div"></div>
    <div class="home_div_container">
        <h1 class="h1_text">MENTOR MATE IS A FREE ONLINE MENTORING SYSTEM</h1>
    </div>
    <button class="login_button" id="myBtn">Get Started</button>
    <br>
    <br>
    <div class="h1_bottom">WHAT MENTORMATE  PROVIDES</div>
    <br>
    <br>
    <div class="flex-container">
        <div class="flex">
            <h1 class="flex_h1">IN PERSON</h1>
            <p class="flex_p">Mentor Mate allows the student to meet <br>the mentor in person and solve their queries.</p>
        </div>
        <div class="flex">
            <h1 class="flex_h1">EXTRA MATERIALS</h1>
            <p class="flex_p">Mentor Mate provides extra material to the students for practice.</p>
        </div>
        <div class="flex">
            <h1 class="flex_h1">PROBLEM SOLVING</h1>
            <p class="flex_p">The mentor will solve the queries  of the student.
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <hr>
    <div class="support">
        <h1 class="support_h1" id="support_start">Get In Touch</h1>
        <br>
        <input type="text" class="support_input" placeholder="Name">
        <input type="text" class="support_input" placeholder="Email">
        <br>
        <h1 class="support_h1">Message</h1>
       <!-- <input type="text" class="support_input_msg" placeholder="Message"> -->
        <br>
        <input class="box1" id="box1" rows="4" cols="100" placeholder="Message"></input>
        <br>
        <button class="send_btn" id="myBtn">Send</button>
    </div>
</body>
<script type="text/javascript">
    var btn = document.getElementById('myBtn');
    btn.addEventListener('click', function() {
    document.location.href = 'register.php';
    });
    
    var btn = document.getElementById('nav_bar_btn_s');
    btn.addEventListener('click', function() {
    document.location.href = 'login.php';
    });

    var btn = document.getElementById('nav_bar_btn_m');
    btn.addEventListener('click', function() {
    document.location.href = 'mentor_login.php';
    });
</script>
</html>