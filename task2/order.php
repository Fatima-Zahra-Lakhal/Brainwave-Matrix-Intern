<?php
include 'conection.php';
session_start();
$user_id = $_SESSION['user_id'];
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
    $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name='$name' AND email='$email' AND number='$number' AND message='$message'") or die('query failed');
    if(mysqli_num_rows($select_message) > 0){
        echo 'message already sent'; 
    } else {
        mysqli_query($conn, "INSERT INTO `message` (`user_id`,`name`,`email`,`number`,`message`) VALUES ('$user_id','$name','$email','$number','$message')") or die('query failed');
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
        <h1>Contact</h1>
        <p>We are at your service. You can contact our team for help.</p><br>
        <a href="index1.php">Home</a><span>/Contact</span>
    </div>
</div>
<div class="line3"></div>
<div class="line3"></div>
<div class="order-section">
    <div class="box-containner">
        <?php
        $select_orders = mysqli_query($conn, "SELECT * FROM `order` WHERE user_id='$user_id'") or die("Query failed: " . mysqli_error($conn));

        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
        ?>
            <div class="box"> 
                <div class="order-item">
                    <b>Placed on :</b><span><?php echo $fetch_orders['placed_on']; ?></span>
                </div>
                <div class="order-item">
                    <b>User name :</b><span><?php echo $fetch_orders['name']; ?></span>
                </div>
                <div class="order-item">
                    <b>Number :</b><span><?php echo $fetch_orders['number']; ?></span>
                </div>
                <div class="order-item">
                    <b>Email :</b><span><?php echo $fetch_orders['email']; ?></span>
                </div>
                <div class="order-item">
                    <b>Address :</b><span><?php echo $fetch_orders['address']; ?></span>
                </div>
                <div class="order-item">
                    <b>Payment method :</b><span><?php echo $fetch_orders['method']; ?></span>
                </div>
                <div class="order-item">
                    <b>Your order :</b><span><?php echo $fetch_orders['total_products']; ?></span>
                </div>
            </div>
        <?php
            }
        } else {
            echo '<p style="border: 2px solid orange; color: black; padding: 10px; text-align: center; border-radius: 5px;">
        No orders found for this user.
      </p> <br>';
        }
        ?>
    </div>
</div>
<br>
<div class="line3"></div>
<div class="line3"></div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
