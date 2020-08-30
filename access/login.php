<?php
session_start();
session_destroy();
?>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<head>
    <title>Blue Mountain</title>
    <link rel="icon" type="image/png" href="../res/logo/logo_ico_outline.png">
    <link rel="stylesheet" type="text/css" href="../res/css/access.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .w3-wide {
            font-family: "Montserrat", sans-serif;
        }
    </style>

<body>

    <div class="accessbox">
        <center onclick="location.replace('../');" style="cursor: pointer;">
            <img src="../res/logo/logo_ico_outline.png" style="width: 50px;height:50px;">
            <h2 class="w3-wide"><b>Blue Mountain</b></h2>
        </center>
        <br>
        <form id="login_form" onsubmit="return false">
            <div class="w3-padding">
                <p><i class="fa fa-envelope w3-margin-right" aria-hidden="true"></i>Email</p>
                <input type="email" class="w3-small" name="uemail" id="uemail_id" placeholder="Enter Your Email" required onfocus="clrErr()">
                <p><i class="fa fa-key w3-margin-right" aria-hidden="true"></i>Password</p>
                <input type="password" class="w3-small" name="upass" id="upass_id" placeholder="Enter Your Password" required onfocus="clrErr()">
                <div class="successalert" id="logSucDisplay" style="display: none;"></div>
                <div class="dangeralert" id="logErrDisplay" style="display: none;overflow:auto;"></div>
                <input type="submit" name="loginSubmit" id="login_submit" value="Login">
                <a href="register.php">Don't have an account? <b>Register</b></a>
            </div>
        </form>
    </div>

    <script src="../res/js/login.js"></script>
</body>
</head>

</html>