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
        $message[]="product already exist in card";    
    }else if(mysqli_num_rows($cart_numr)>0){
        $message[]="product already exist in wishlist";
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
        $message[]="product already exist in cart";
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
                <h1>Our shop</h1>
                <p>Welcome to our shop, where you'll find a curated selection of our finest natural honey products. From classic wildflower honey to rare, single-origin varieties, each jar reflects our commitment to quality and sustainability. Explore our range and discover the perfect addition to your pantry, whether for daily enjoyment or a special gift. Enjoy the pure taste of nature, delivered directly to your door.</p><br>
                <br><a href="index1.php">home</a><span>/shoup</span>
            </div>
        </div>
        <div class="line3"></div>
        <div class="line3"></div>
<section class="shop">
    <h1 class="title">shop best sellers</h1>
    <?php if(isset($message)){
                foreach ($message as $mes){
                   echo'
                    <div class="message">
                        <span>'.$mes.'</span>
                        <i class="bi bi-x-circle" onclick="this.parentElement.remove()"></i>
                    </div>';
                }
             } ?>
    <div class="popilar-brands-content" id="boxx">
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die("Query failed");
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>
        <form method="post" class="card" id="shopp">
            <div class="ligne">
            <img src="image/<?php echo $fetch_products['image']; ?>" alt="<?php echo htmlspecialchars($fetch_products['name']); ?>">
            <div class="price"><?php echo htmlspecialchars($fetch_products['price']); ?>DH</div>
            <div class="name"><?php echo htmlspecialchars($fetch_products['name']); ?></div>
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($fetch_products['id']); ?>">
            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch_products['name']); ?>">
            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($fetch_products['price']); ?>">
            <input type="hidden" name="product_quantity" value="1" min="1">
            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch_products['image']); ?>">
        </div>
            <div class="icon">
                <a href="view_page.php?pid=<?php echo htmlspecialchars($fetch_products['id']); ?>" class="bi bi-eye-fill"></a>
                <button type="submit" name="add_to_wishlist" class="bi bi-heart"></button>
                <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
            </div>
        </form>
        <?php       
            }
        } else {
            echo '<p class="empty">No products added yet!</p>';
        }
        ?>
    </div>
</section>
        <div class="line3"></div>
        <div class="line3"></div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>