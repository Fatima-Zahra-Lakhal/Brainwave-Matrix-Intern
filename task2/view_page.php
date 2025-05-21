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
if (isset($_POST['add_to_wishlist'])){
    $product_id=$_POST['product_id'];
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_image=$_POST['product_image'];
    $wishlist_numbrer=mysqli_query($conn,"SELECT * FROM `wishlist` WHERE name='$product_name' AND user_id='$user_id'")or die ('query failed');
    $cart_numr=mysqli_query($conn,"SELECT * FROM `cart` WHERE name='$product_name' AND user_id='$user_id'")or die ('query failed');
    if(mysqli_num_rows($wishlist_numbrer)>0){
        $message[]="product already exist in wishlist";    
    }else if(mysqli_num_rows($cart_numr)>0){
        $message[]="product already exist in card";
    }else{
        mysqli_query($conn,"INSERT INTO `wishlist` (`user_id`,`pid`,`name`,`price`,`image`) VALUES('$user_id','$product_id','$product_name','$product_price','$product_image')");
        $message[]="product successfuly added in your wishlist";
    }
}
if (isset($_POST['add_to_cart'])) {
    $product_id=$_POST['product_id'];
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_image=$_POST['product_image'];
    $product_quantity=$_POST['product_quantity'];
    $cart_numr=mysqli_query($conn,"SELECT * FROM `cart` WHERE name='$product_name' AND user_id='$user_id'")or die ('query failed');   
    if(mysqli_num_rows($cart_numr)>0){
        $message[]="product already exist in card";
    }else{
        mysqli_query($conn,"INSERT INTO `cart` (`user_id`,`pid`,`name`,`price`,`quantity`,`image`) VALUES('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
        $message[]="product successfuly added in your cart";
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
    <link rel="stylesheet" href="main.css"> <!-- Inclure le CSS principal -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
</head>
<body id="ia">
<?php include 'header.php'; ?>
<div class="line2"></div>
<div class="banner">
            <div class="detail">
                <h1>product detail</h1>
                <p>Explore the unique characteristics of each of our honey varieties. From the floral notes of our wildflower honey to the deep, robust flavor of our forest honey, every product is crafted with precision. Learn more about the origin, flavor profile, and health benefits of each jar, and find the perfect match for your taste. Our honey is more than just a sweetener—it's a journey through nature's finest offerings</p><br>
                <br><a href="index1.php">home</a><span>/shop</span>
            </div>
        </div>
        <div class="line3"></div>
        <div class="line3"></div>
<section class="view_page">
    <?php if(isset($message)){
                foreach ($message as $mes){
                   echo'
                    <div class="message">
                        <span>'.$mes.'</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>';
                }
             } ?>
        <?php
            if(isset($_GET['pid'])){
                $pid=$_GET['pid'];
                $select_products=mysqli_query($conn,"SELECT *FROM `products` WHERE id='$pid'") or die('query failed');
                if(mysqli_num_rows($select_products)>0) {
                    while($fetch_products=mysqli_fetch_assoc($select_products)){
        ?>
        <form method="post">
            <img src="image/<?php echo $fetch_products['image'];?>" alt="<?php echo htmlspecialchars($fetch_products['name']); ?>">
            <div class="details">
            <div class="price"><?php echo htmlspecialchars($fetch_products['price']); ?>DH</div>
            <div class="name"><?php echo htmlspecialchars($fetch_products['name']); ?></div>
            <div class="detail"><?php echo htmlspecialchars($fetch_products['product_detail']); ?></div>
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($fetch_products['id']); ?>">
            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch_products['name']); ?>">
            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($fetch_products['price']); ?>">
            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch_products['image']); ?>">
            <div class="icon">
                <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                <input type="number" name="product_quantity" value="1" min="1" class="quantity">
                <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
            </div>
             </div>
        </form>
        <?php       
            }
        }
    }
        ?>
</section>
        <div class="line3"></div>
        <div class="line3"></div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>