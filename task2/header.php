<!DOCTYPE html>
<html lang="en">
<head>
<link rel="icon" type="image/x-icon" href="icon.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
<meta name="viewport" content="width=device-width , initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="main.css">
<title>user page</title>
</head>
<body  id="header">
    <header class="header">
        <div class="flex">
            <a href="admin_pannel.php" class="logo"></a>
            <nav class="navbar">
                <a href="index1.php">HOME</a>
                <a href="about.php">ABOUT</a>
                <a href="shop.php">SHOP</a>
                <a href="order.php">ORDER</a>
                <a href="contact.php">CONTACT</a>
            </nav>
            <div class="icons" id="idd"> 
                  <?php
                $select_wishlist=mysqli_query($conn,"SELECT * FROM `wishlist` WHERE user_id='$user_id'")or die("qeury failed");
                    $wishlist_num_rows=mysqli_num_rows($select_wishlist);
                ?>    

                <a href="wishlist.php"><i class="bi bi-heart"></i><sup><?php echo $wishlist_num_rows;?></sup></a>  
                <?php
                $select_cart=mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id'")or die("qeury failed");
                    $cart_num_rows=mysqli_num_rows($select_cart);
                ?>
              
                <a href="cart.php"><i class="bi bi-cart"></i><sup><?php echo $cart_num_rows;?></sup></a> 
           
                <i class="bi bi-person" id="user-btn"></i>
                <i class="bi bi-list" id="menu-btn"></i>
             </div>
            <div class="User-box" idd="a">
                <p>username: <span><?php echo $_SESSION['user_name']; ?></span></p>
                <p>email: <span><?php echo $_SESSION['user_email']; ?></span></p>
                <form method="post">
                    <button type="submit" name="logout" class="logout_btn">log out</button>
                </form>
            </div>
            </div>
            <img class="f" src="./image/logobeensi.png">
    </header>
    <script type="text/javascript" src="script2.js"></script>
</body>
</html>