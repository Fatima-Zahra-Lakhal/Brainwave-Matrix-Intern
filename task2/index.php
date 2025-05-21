<?php
include 'conection.php';
session_start();

$user_id = $_SESSION['user_name'];
if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
    exit();
}
?>
<style type="text/css"
   <?php include 'main.css';?>></style>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width , initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php 
           include 'header.php';
           ?> 
           <div class="line3"></div>
           <p>site</p>
    </body>
    
</html>