<?php
include 'conection.php';
session_start();

$admin_id = $_SESSION['admin_name'];
if (!isset($admin_id)) {
    header('location:login.php');
    exit();
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location:login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<link rel="icon" type="image/x-icon" href="icon.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
<meta name="viewport" content="width=device-width , initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Admin Panel</title>
</head>
<body>
    <?php include 'admin_header.php';?>
    <div class="line4"></div>
    <section class="dashboard">
          <div class="box-container">
            <div class="box">
              <?php $total_pendings=0;
             $select_pendings = mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status='pending'")or die('failed query');
              while ($fetch_pending = mysqli_fetch_assoc($select_pendings)) {
                $total_pendings +=$fetch_pending['total_price'];
              }?>
                <h3><?php echo $total_pendings;?>/-</h3>
                      <p>total pending</p>
            </div>
            <div class="box">
                <?php $total_complets=0;
                       $select_complets = mysqli_query($conn, "SELECT * FROM `order` WHERE payment_status='complets'") 
                     or die('query failed');
                      while($fetch_complets = mysqli_fetch_assoc($select_complets)){
                        $total_complets +=$fetch_pending['total_price'];
                      }
                      ?>
                      <h3><?php echo $total_complets;?>/-</h3>
                      <p>total complets</p>
          </div>
          <div class="box">
                <?php 
                       $select_orders= mysqli_query($conn, "SELECT * FROM `order` ") 
                     or die('query failed');
                   
                       
                        $num_orders=mysqli_num_rows($select_orders);
                      ?>
                      <h3><?php echo $num_orders;?>/-</h3>
                      <p>order placed</p>
          </div>
          <div class="box">
                <?php 
                       $select_products= mysqli_query($conn, "SELECT * FROM`order` ") 
                     or die('query failed');
                   
                       
                        $num_products=mysqli_num_rows($select_products);
                      ?>
                      <h3><?php echo $num_products;?>/-</h3>
                      <p>product added</p>
          </div>
          <div class="box">
                <?php 
                       $select_users= mysqli_query($conn, "SELECT * FROM`users` WHERE user_type='user'") 
                     or die('query failed');
                   
                       
                        $num_user=mysqli_num_rows($select_users);
                      ?>
                      <h3><?php echo $num_user;?>/-</h3>
                      <p>total normal users</p>
          </div>
          <div class="box">
                <?php 
                       $select_admins= mysqli_query($conn, "SELECT * FROM`users` WHERE user_type='admin'") 
                     or die('query failed');
                   
                       
                        $num_admin=mysqli_num_rows($select_admins);
                      ?>
                      <h3><?php echo $num_admin;?>/-</h3>
                      <p>total admin</p>
          </div>
          <div class="box">
                <?php 
                       $select_users= mysqli_query($conn, "SELECT * FROM`users`") 
                     or die('query failed');
                   
                       
                        $num_users=mysqli_num_rows($select_users);
                      ?>
                      <h3><?php echo $num_users;?>/-</h3>
                      <p>total registred users</p>
          </div>
          <div class="box">
                <?php 
                       $select_message= mysqli_query($conn, "SELECT * FROM`message`") 
                     or die('query failed');
                   
                       
                        $num_message=mysqli_num_rows($select_message);
                      ?>
                      <h3><?php echo $num_message;?>/-</h3>
                      <p>new messages</p>
          </div>
          </div>
  </section>
    <script type="text/javascript" src="script.js"></script>
</body> 
</html>

