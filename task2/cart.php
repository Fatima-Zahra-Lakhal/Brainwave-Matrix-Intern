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
if (isset($_POST['update_qty_btn'])) {
    $update_qty_id = $_POST['update_qty_id'];
    $update_value = $_POST['update_qty'];
    $update_query = mysqli_query($conn, "UPDATE `cart` SET quantity='$update_value' WHERE id='$update_qty_id'") or die("query failed");

    if ($update_query) {
        header('location:cart.php');
    }
}
if(isset($_GET['delete'])){
    $delete_id= $_GET['delete'];
    mysqli_query($conn,"DELETE FROM cart WHERE id='$delete_id'")or die('query failed');
    $message[]="product is delete successfuly";
}
if(isset($_GET['delete_all'])){
    $delete_id= $_GET['delete_all'];
    mysqli_query($conn,"DELETE FROM wishlist WHERE id='$delete_id'")or die('query failed');
    header('location:cart.php');
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
                <h1>my cart</h1>
                <p>Your cart is brimming with the finest honey selections, each one chosen to delight your senses. As you prepare to complete your purchase, know that you're bringing home the purest flavors nature has to offer. Whether it’s the light, floral essence of wildflower honey or the rich, earthy tones of forest honey, each jar promises a taste of quality and craftsmanship. Take the next step and indulge in the sweetness that awaits.</p><br>
                <br><a href="index1.php">home</a><span>/cart</span>
            </div>
        </div>
        <div class="line3"></div>
        <div class="line3"></div>
        <section class="shop">
    <h1 class="title">products added in cart</h1>
    <?php if(isset($message)){
                foreach ($message as $mes){
                   echo'
                    <div class="message">
                        <span>'.$mes.'</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>';
                }
             } ?>
    <div class="popilar-brands-content" id="sh">
        <?php
        $grand_total=0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart`") or die("Query failed");
        if (mysqli_num_rows($select_cart) > 0) {
            while ($fetch_cart = mysqli_fetch_assoc($select_cart)){
        ?>
       <div class="card" id="shopp">
        <div class="icon">
                <a href="view_page.php?pid=<?php echo $fetch_cart['pid']; ?>" class="bi bi-eye-fill"></a>
                <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="bi bi-x" onclick="return confirm('do you want to delete this product from your cart')"></a>
                <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
            </div>
            <img src="image/<?php echo $fetch_cart['image']; ?>" alt="<?php echo htmlspecialchars($fetch_cart['name']); ?>">
            <div class="price"><?php echo htmlspecialchars($fetch_cart['price']); ?>DH</div>
            <div class="name"><?php echo htmlspecialchars($fetch_cart['name']); ?></div>
           <form method="post">
            <input type="hidden" name="update_qty_id" value="<?php echo $fetch_cart['id']; ?>"> 
            <div id="bx">
          <div class="qty">
            <input type="number" min="1" name="update_qty"  value="<?php echo $fetch_cart['quantity']; ?>" id="btn1">
            <input type="submit" name="update_qty_btn" value="update" id="btn1">
          </div>
          <div class="total-amt">
                Toutal Amount : <span><?php echo $total_amt= ($fetch_cart['price']*$fetch_cart['quantity'])?></span>
            </div>
        </div>
        </form>
       </div>
        <?php 
             $grand_total+=$total_amt ;    
            }
        } else {
            echo '<p class="empty">No products added yet!</p>';
        }
        ?>
       </div>
       <div class="dlt">
       <a href="cart.php?delete_all" class="btn2" onclick="return confirm('do you want to delete all items in your wishlist')">delete all</a>
    
       </div>
    <div class="wishlist_total">
        <p>total amount payable:<span><?php echo $grand_total ;?>DH</span></p><br>
        <a href="shop.php" class="btn">continue shoping</a>
        <a href="checkout.php" class="btn" <?php echo ($grand_total>1)?'':'disabled'?> onclick="return confirm('do you want to delete all items in your wishlist')">proceed to checkout</a>
    </div>
</section> 
        <div class="line3"></div>
        <div class="line3"></div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>