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
if(isset($_POST['submit-btn'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email= mysqli_real_escape_string($conn, $_POST['email']);
    $number= mysqli_real_escape_string($conn, $_POST['number']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $select_message=mysqli_query($conn,"SELECT * FROM `message` WHERE name='$name' AND email='$email' AND number='$number' AND message='$message'") or die('query failed');
    if(mysqli_num_rows($select_message)>0){
        echo 'message already send'; 
    }else{
        mysqli_query($conn, "INSERT INTO `message` (`user_id`,`name`,`email`,`number`,`message`) VALUES ('$user_id','$name','$email ','$number','$message')") or die('query failed');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
</head>
<body id="ia">
<?php include 'header.php'; ?>
<div class="line2"></div>
<div class="banner">
            <div class="detail">
                <h1>contact</h1>
                <p>we are in your service you can contact our team for help you </p><br>
                <br><a href="index1.php">home</a><span>/contact</span>
            </div>
        </div>
        <div class="line3"></div>
        <div class="line3"></div>
        <div class="services">
        <div class="row">
            <div class="box">
                <img src="./image/250-2506303_product-logo-cargo-ship-portable-network-graphics-fast-removebg-preview.png">
                <div>
                    <h1>Free Shipping Fast</h1>
                    <p>"Get Your Orders with Blazing Fast Free Shipping_No Minimum Purchase!"</p>
                </div>
            </div>
            <div class="box">
                <img src="./image/Money-back-guarantee-rubber-label-stamp-seal-on-transparent-background-PNG-removebg-preview.png">
                <div>
                    <h1>Money Back & Guarantee</h1>
                    <p> Blazing Fast Free Shipping & Money-Back Guarantee!"</p>
                </div>
            </div>
            <div class="box">
                <img src="./image/th__11_-removebg-preview.png">
                <div>
                    <h1>online Suport 24/7</h1>
                    <p>"24/7 Online Support: We're Here for You Anytime, Day or Night!"</p>
                </div>
            </div>
        </div>
    </div>
    <div class="form-container">
        <h1 class="title">leave a message</h1>
        <form method="post">
        <div class="input-failed">
            <label>your name<br></label>
            <input type="text" name="name">
        </div>
        <div class="input-failed">
            <label>your email<br></label>
            <input type="text" name="email">
        </div>
        <div class="input-failed">
            <label>number<br></label>
            <input type="int" name="number">
        </div>
        <div class="input-failed">
            <label>message<br></label>
            <textarea name="message"></textarea>
        </div>
        <button type="submit" name="submit-btn">send message</button>
        </form>
    </div>
    <div class="line3"></div>
    <div class="address">
        <h1 class="title"> our contact</h1>
         <div class="row">
            <div class="box">
                <i class="bi bi-map-fill"></i>
                    <div>
                        <h4>address</h4>
                        <p>1908 Marigold Lane,Coral Way <br> Miami,Florida,578547</p>
                    </div>
            </div>
            <div class="box">
                <i class="bi bi-telephone-fill"></i>
                    <div>
                        <h4>phone number</h4>
                        <p>0619750895</p>
                    </div>
            </div>
            <div class="box">
                <i class="bi bi-envelope-fill"></i>
                    <div>
                        <h4>email</h4>
                        <p>fatimazahrae.lakhak01@gmail.com</p>
                    </div>
            </div>
       
    </div>  
    </div>
        <div class="line3"></div>
        <div class="line3"></div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>