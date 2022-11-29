<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$college_id = $authen_code = $email = $username = $password = $confirm_password = "";
$college_id_err = $authen_code_err = $email_err = $username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM mentor_users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

        // Validate email
        if(empty(trim($_POST["email"]))){
            $email_err = "Please enter an email.";
        } else{
            // Prepare a select statement
            $sql = "SELECT id FROM mentor_users WHERE email = ?";
            
            if($stmt = mysqli_prepare($link, $sql)){
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "s", $param_email);
                
                // Set parameters
                $param_username = trim($_POST["email"]);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($stmt)){
                    /* store result */
                    mysqli_stmt_store_result($stmt);
                    
                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $email_err = "This email is already registered.";
                    } else{
                        $email = trim($_POST["email"]);
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
    
                // Close statement
                mysqli_stmt_close($stmt);
            }
        }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    
    // Validate authen_code
    // if(empty(trim($_POST["authen_code"]))){
    //     $suthen_code_err = "Please confirm password.";     
    // } else{
    //     //
    //     $sql = "SELECT `id` FROM `authentication_code` WHERE `authen_code` = '".$_POST["authen_code"]."';";
    //     $result = mysqli_query($link, $sql);
    //     if(mysqli_num_rows($result) > 0)
    //     {
    //         $authen_code = trim($_POST["authen_code"]);
    //     }
    //     else
    //     {
    //         if(empty($authen_code_err) /*&& ($authen_code != "LJPOLY633")*/){
                
    //             $authen_code_err = "Wrong authentication code.";
    //         } else{
    //             echo $authen_code;
    //         }
    //     }


    //     //
        
        
    // }
    //----------------------------------
    if(empty(trim($_POST["authen_code"]))){
        $suthen_code_err = "Please confirm password.";     
    } else{
        //
        $sql = "SELECT `id` FROM `college_id_table` WHERE `college_authentication_code` = '".$_POST["authen_code"]."';";
        $result = mysqli_query($link, $sql);
        if(mysqli_num_rows($result) > 0)
        {
            $authen_code = trim($_POST["authen_code"]);
        }
        else
        {
            if(empty($authen_code_err) /*&& ($authen_code != "LJPOLY633")*/){
                
                $authen_code_err = "Wrong authentication code.";
            } else{
                echo $authen_code;
            }
        }


        //
        
        
    }





    //-----------------------------------
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Validate college id
    if(empty(trim($_POST["college_id"])))
    {
        $confirm_password_err = "Please confirm college_id.";     
    }
    else
    {
        $sql = "SELECT * FROM `college_id_table` WHERE `college_id` = '".$_POST["college_id"]."';";
        $result = mysqli_query($link, $sql);
        if(mysqli_num_rows($result) > 0)
        {
            $college_id = trim($_POST["college_id"]);  
        }
        else
        {
            if(empty($confirm_password_err)){
                $college_id_err = "Please check college id.";
            } 
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err) && empty($authen_code_err) && empty($college_id_err) ){
        
        // Prepare an insert statement
        $sql2 = "INSERT INTO mentor_users (username, password, email, authen_code, college_id) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql2)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_email, $param_authen_code, $param_college_id);
            
            // Set parameters
            $param_authen_code = $authen_code;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_email = $email;
            $param_college_id = $college_id;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="mentor_register_style.css">
  <link href='http://fonts.googleapis.com/css?family=Poppins' rel='stylesheet' type='text/css'>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
</head>
<body>
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="homepage.php">MentorMate</a>
        </div>
        <ul class="nav navbar-nav">
        <li ><a href="home_page.php">Home</a></li>
        <li ><a href="home_page.php #support_start">Support</a></li>
        </ul>
    </div>
    </nav>
    <div class="container">
        <br>
        <br>
        <h2>Sign Up As Mentor</h2>
        <br>
        <br>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Username" require>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <br>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Email" require>
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <br>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" placeholder="Password" require>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <br>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" placeholder="Confirm Password" require>
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <br>
            <div class="form-group <?php echo (!empty($authen_code_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="authen_code" class="form-control" value="<?php echo $authen_code; ?>" placeholder="Authentication Code" require>
                <span class="help-block"><?php echo $authen_code_err; ?></span>
            </div>
            <br>
            <div class="form-group <?php echo (!empty($authen_code_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="college_id" class="form-control" value="<?php echo $college_id; ?>" placeholder="College Id" require>
                <span class="help-block"><?php echo $college_id_err; ?></span>
            </div>
            <br>
            <div class="form-group" id="two_buttons">
                <input type="submit" class="btn btn-primary" value="Submit" id="button_1">
                <input type="reset" class="btn btn-default" value="Reset" id="button_2">
            </div>
            <br>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
    <br><br>
</body>
</html>