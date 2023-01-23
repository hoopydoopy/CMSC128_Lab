<?php
        session_start();

        include("connection.php");
        include("functions.php");
    
        $user_data = check_login($con);
    

        //session timeout
        if( isset($_SESSION['last_active']) && (time() - $_SESSION['last_active'] > 5*60) ){
            header('refresh:4; url=logout.php');
            echo '<div class="errbox"><p class="errmsg">You have been inactive for too long. Please log in again.</p></div>';
            die;
        }else{
            session_regenerate_id(true);
            $_SESSION['last_active'] = time();
        }


?>



<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="index">
    <button class="logout-btn" onclick="location.href='logout.php'">Logout</button>
    <h1 class="welcome">Welcome.</h1>

    <br>
   

</body>
</html>