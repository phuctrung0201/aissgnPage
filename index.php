<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body class='bg-light h-100 '>
<?php
session_start();
if(isset($_POST['control'])){
    require "controller/con".$_POST['control'].".php";
} elseif (isset($_SESSION['control'])) {
    require "controller/con".$_SESSION['control'].".php";
} else {
    require 'controller/conLogin.php';
}
?>
<script src='public\js\jquery-3.3.1.min.js'></script>
<script src='public\js\bootstrap.min.js'></script>
</body>
</html>