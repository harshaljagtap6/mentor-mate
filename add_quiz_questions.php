<?php
// Include config file
require_once "config.php";

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
$total = "";
if (isset($_GET['total_questions']))
{
    $total = $_GET['total_questions'];
}

$quiz_name = $_GET['quiz_name'];
$quiz_subject = $_GET['quiz_subject'];

$quiz_id = '';
$quiz_by = '';

$sql1 = "SELECT * from `quiz` ORDER BY `quiz_id` DESC LIMIT 1;";
$result = mysqli_query($link, $sql1);
if (mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_array($result))
    {
        $quiz_id = $row['quiz_id'];
        $quiz_by = $row['quiz_by'];
    }
}



mysqli_close($link);
?>

<!DOCTYPE html>
<html>

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="book_appointment.css">
    <link href='http://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' type='text/css'>

</head>

<body>
    <nav class="navbar navbar-inverse" id="navigation_bar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="home_page.php">MentorMate</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="mentor_welcome.php">Home</a></li>
                <li><a href="home_page.php #support_start">Support</a></li>
                <li><a href="#">Book An Appointmeet</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                <li><a href="reset-password.php"><span class="glyphicon glyphicon-asterisk"></span> Reset Password</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <form action=add_question_action_page.php method="post">
            <?php
                echo '<input type="number" hidden name="total" value='.$total.'>';
                echo '<input type="text" hidden name="quiz_name" value="'.$quiz_name.'">';
                echo '<input type="text" hidden name="quiz_subject" value="'.$quiz_subject.'">';
                echo '<input type="text" hidden name="quiz_id" value="'.$quiz_id.'">';
                echo '<input type="text" hidden name="quiz_by" value="'.$quiz_by.'">';
                for ($x = 0; $x < $total; $x++)
                {
                    echo '<div class="maman">
                    Enter question :<br><br>
                    <input type=text name="question[]" ><br><br>
                    Enter option A:
                    <input type="text" name="option_A[]" required><br><br>
                    Enter option B:
                    <input type="text" name="option_B[]" required><br><br>
                    Enter option C: 
                    <input type="text" name="option_C[]" required><br><br>
                    Enter option D: 
                    <input type="text" name="option_D[]" required><br><br>
                    
                    Select Answer:
                    <select name=selects[]>
                        <option value="option_a" name="option_a[]">A</option>
                        <option value="option_b" name="option_b[]">B</option>
                        <option value="option_c" name="option_c[]">C</option>
                        <option value="option_d" name="option_d[]">D</option>
                    </select>
                    <!--Enter option D: 
                    <input type="text" name="option_D[]" required><br><br>-->

                    </div><br><br>';
                }
                echo '<input type="submit" id="edit_button">';
            ?>
        </form>
    </div>
</body>

</html>