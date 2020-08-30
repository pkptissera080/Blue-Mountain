<!--headerLinkRel------------------------------------------------------------------------------------------------------>
<?php
session_start();
include_once '../classes/DbConnecter.php';
include_once '../classes/User.php';
if (!isset($_SESSION["current_user"]) || $_SESSION["current_user"] == null) {
    $loginState = 'false';
} else {
    $loginState = 'true';
    $firstName = unserialize($_SESSION['current_user'])->getFname();
    $lastName = unserialize($_SESSION['current_user'])->getLname();
}
?>
<!DOCTYPE html>
<html lang="en">
<title>Blue Mountain</title>
<link rel="icon" type="image/png" href="../res/logo/logo_ico_outline.png">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="../res/css/main.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!--/.headerLinkRel------------------------------------------------------------------------------------------------------>