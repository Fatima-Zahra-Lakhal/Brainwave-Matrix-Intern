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
if(isset($_GET['delete'])){
    $delete_id= $_GET['delete'];
    mysqli_query($conn,"DELETE FROM `order` WHERE id='$delete_id'")or die('query failed');
    $message[]='no order placed yet';
    header('location:admin_order.php');
}
// update payment status
if(isset($_POST['update_payment'])){
    $order_id=$_POST['order_id'];
    $update_payment = $_POST['update_payment'];
    mysqli_query($conn,"UPDATE `order` SET payment_status='$update_payment' WHERE id='$order_id'")or die('query failed');
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
<title>total users account</title>
</head>
<body id="ff">
    <?php include 'admin_header.php'?>
    <?php
             if(isset($message)){
                foreach ($message as $mes){
                   echo'
                    <div class="message">
                        <span>'.$mes.'</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>';
                }
             }
             ?>
      <div class="line2"></div>
      <section class="message-container order_container">
    <h1 class="title">total order placed</h1>
    <div class="box-container box_co">
        <?php 
        $select_orders = mysqli_query($conn, "SELECT * FROM `order`") or die('query failed');
        if (mysqli_num_rows($select_orders) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                ?>
                <div class="box">
                    <div class="order-item">
                        <b>user name :</b><span><?php echo $fetch_orders['name']; ?></span>
                    </div>
                    <div class="order-item">
                        <b>user id :</b><span><?php echo $fetch_orders['id']; ?></span>
                    </div>
                    <div class="order-item">
                        <b>placed on :</b><span><?php echo $fetch_orders['placed_on']; ?></span>
                    </div>
                    <div class="order-item">
                        <b>number :</b><span><?php echo $fetch_orders['number']; ?></span>
                    </div>
                    <div class="order-item">
                        <b>email :</b><span><?php echo $fetch_orders['email']; ?></span>
                    </div>
                    <div class="order-item">
                        <b>total price :</b><span><?php echo $fetch_orders['total_price']; ?></span>
                    </div>
                    <div class="order-item">
                        <b>method :</b><span><?php echo $fetch_orders['method']; ?></span>
                    </div>
                    <div class="order-item">
                        <b>address :</b><span><?php echo $fetch_orders['address']; ?></span>
                    </div>
                    <div class="order-item">
                        <b>total product :</b><span><?php echo $fetch_orders['total_products']; ?></span>
                    </div>
                    <form method="POST">
                        <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                        <select name="update_payment">
                            <option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
                            <option value="pending">pending</option>
                            <option value="complete">complete</option>
                        </select>
                        <input type="submit" name="update_order" value="update payment" class="btn">
                        <a href="admin_order.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('want to delete this order')" class="delete">delete</a>
                    </form>
                </div>
                <?php   
                }
            }else{  echo '<div class="empty"><p>no messages found!</p></div>';}
            ?>
        </div>
      </section>
    <script type="text/javascript" src="script.js"></script>
</body> 
</html>