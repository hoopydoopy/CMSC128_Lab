<?php
   session_start();

   include("connection.php");
   include("functions.php");


   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {

       $username = $_POST['username'];
       $password = $_POST['password'];


       if(!empty($username) && !empty($password))
       {

           //read from database
           $query = "select * from users where username = '$username' limit 1";
           $result = mysqli_query($con, $query);
           
           if($result)
           {
                if($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    
                    if($user_data['password'] === $password)
                    {


                        $_SESSION['user_id'] = $user_data['user_id'];

                        //for session timeout
                        $_SESSION['last_active'] = time();

                        header("Location: index.php");
                        die;
                    }
                }
           }

           echo '<div class="errbox"><p class="errmsg">Your username and password do not match. Please try again.</p></div>';


       }else
       {
        echo '<div class="errbox"><p class="errmsg">Oops, looks like you forgot to enter your username or password.</p></div>';
       }
   }
    
?>



<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="toggle.js"></script>

</head>

<body class="login">




    <div id="box">
        <form method="post">
            <div class="text-font">Login</div>
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

            <input id="button" type="submit" value="Login">
            <br><br>

            <a href="register.php">Not registered?</a>
        </form>
    </div>
</body>
</html>