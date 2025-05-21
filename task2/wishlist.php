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
if (isset($_POST['add_to_cart'])) {
    $product_id=$_POST['product_id'];
    $product_name=$_POST['product_name'];
    $product_price=$_POST['product_price'];
    $product_image=$_POST['product_image'];
    $product_quantity=1;
    $cart_numr=mysqli_query($conn,"SELECT * FROM `cart` WHERE name='$product_name' AND user_id='$user_id'")or die ('query failed');   
    if(mysqli_num_rows($cart_numr)>0){
        $message[]="product already exist in cart";
    }else{
        mysqli_query($conn,"INSERT INTO `cart` (`user_id`,`pid`,`name`,`price`,`quantity`,`image`) VALUES('$user_id','$product_id','$product_name','$product_price','$product_quantity','$product_image')");
        $message[]="product successfuly added in your cart";
    }
}
if(isset($_GET['delete'])){
    $delete_id= $_GET['delete'];
    mysqli_query($conn,"DELETE FROM wishlist WHERE id='$delete_id'")or die('query failed');
    $message[]="product is delete successfuly";
}
if(isset($_GET['delete_all'])){
    $delete_id= $_GET['delete_all'];
    mysqli_query($conn,"DELETE FROM wishlist WHERE id='$delete_id'")or die('query failed');
    header('location:wishlist.php');
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
                <h1>my wishlist</h1>
                <p>Discover the treasures you've handpicked. Each jar in your wishlist is a testament to your unique taste, offering a distinct journey through nature’s finest flavors. Whether you crave the delicate sweetness of wildflower honey or the bold richness of forest honey, these selections are a perfect reflection of your preferences. Explore the stories behind each variety and anticipate the joy they will bring to your table.</p><br>
                <br><a href="index1.php">home</a><span>/wishlist</span>
            </div>
        </div>
        <div class="line3"></div>
        <div class="line3"></div>
        <section class="shop">
    <h1 class="title">products added in wishlist</h1>
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
        $grand_total=0;
        $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist`") or die("Query failed");
        if (mysqli_num_rows($select_wishlist) > 0) {
            while ($fetch_wishlist = mysqli_fetch_assoc($select_wishlist)) {
        ?>
        <form method="post" class="card" id="shopp">
            <div class="ligne">
            <img src="image/<?php echo $fetch_wishlist['image']; ?>" alt="<?php echo htmlspecialchars($fetch_wishlist['name']); ?>">
            <div class="price"><?php echo htmlspecialchars($fetch_wishlist['price']); ?>DH</div>
            <div class="name"><?php echo htmlspecialchars($fetch_wishlist['name']); ?></div>
            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($fetch_wishlist['id']); ?>">
            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($fetch_wishlist['name']); ?>">
            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($fetch_wishlist['price']); ?>">
            <input type="hidden" name="product_quantity" value="1" min="1">
            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($fetch_wishlist['image']); ?>">
        </div>
            <div class="icon">
            <a href="view_page.php?pid=<?php echo htmlspecialchars($fetch_wishlist['pid']); ?>" class="bi bi-eye-fill"></a>
                <a href="wishlist.php?delete=<?php echo $fetch_wishlist['id']; ?>" class="bi bi-x" onclick="return confirm('do you want to delete this product from your wishlist')"></a>
                <button type="submit" name="add_to_cart" class="bi bi-cart"></button>
            </div>
        </form> 
   
        <?php 
             $grand_total+=$fetch_wishlist['price'];      
            }
        } else {
            echo '<p class="empty">No products added yet!</p>';
        }
        ?>
    </div>
    <div class="wishlist_total">
        <p>total amount payable:<span><?php echo $grand_total ;?>DH</span></p><br>
        <a href="shop.php" class="btn">continue shoping</a>
        <a href="wishlist.php?delete_all" class="btn" <?php echo ($grand_total)?'':'disabled'?> onclick="return confirm('do you want to delete all items in your wishlist')">delete all</a>
    </div>
</section>
        <div class="line3"></div>
        <div class="line3"></div>
<?php include 'footer.php'; ?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>