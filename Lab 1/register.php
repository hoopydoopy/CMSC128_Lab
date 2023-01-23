<?php
    session_start();

    include("connection.php");
    include("functions.php");

    //if user has clicked on button
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        //collect data
        $username = $_POST['username'];
        $password = $_POST['password'];


        //check if username and password are not empty
        if(!empty($username) && !empty($password))
        {
            // Check if username already exists
            $check_username = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($con, $check_username);
            if(mysqli_num_rows($result) > 0) {
                echo '<div class="errbox"><p class="errmsg">Sorry, this username is already taken.</p></div>';
            }else{
                    // check for at least 8 characters, one number, one uppercase character, and one symbol
                if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,}$/", $password))
                {
                    echo '<div class="errbox"><p class="errmsg">Please make sure your password meets the requirements.</p></div>';

                }
                else
                {
                    //save to database
                    $query = "insert into users (username, password) values ('$username', '$password')";

                    mysqli_query($con, $query);

                    header("Location: login.php");
                    die;
            }
            }

            
        }
        else //if username or password is left empty
        {
            echo '<div class="errbox"><p class="errmsg">Please enter your username and password.</p></div>';

        }
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    
    <script src="toggle.js"></script>

</head>

<body class="register">




    <div id="box">
        <form method="post">
            <div class="text-font">Register</div>
            <br>


            <input id="text" type="text" name="username" placeholder="Username">
            <br> <br>

            <div class="container">
                <input id="text" type="password" name="password" placeholder="Password">
                <br> <br>

                <span>
                    <i class="fa fa-eye" id="font" onclick="showPassword()" aria-hidden="true"></i>
                </span>
            </div>

            <input id="button" type="submit" value="Sign Up">
            <br><br>

            <a href="login.php">Already registered? Login here.</a>
        </form>
    </div>
    <div id="note">
        <form>
            <h1>Your password must contain the following:<h1>
                <p>*At least eight characters <br>
                    *One uppercase character <br>
                    *One number <br>
                    *One symbol <br>
                </p>
        </form>
    </div>
</body>
</html>