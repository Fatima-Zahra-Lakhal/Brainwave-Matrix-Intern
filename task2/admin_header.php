<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/x-icon" href="icon.png">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Admin Panel</title>
</head>
<body  class="fati">
    <header class="header">
        <div class="flex">
            <a href="admin_pannel.php" class="logo"></a>
            <nav class="navbar">
                <a href="admin_pannel.php">HOME</a>
                <a href="admin_product.php">PRODUCTS</a>
                <a href="admin_order.php">ORDERS</a>
                <a href="admin_user.php">USERS</a>
                <a href="admin_message.php">MESSAGES</a>
            </nav>
             <div class="icons">     
                <i class="bi bi-person" id="user-btn"></i>
                <i class="bi bi-list" id="menu-btn"></i>
             </div> 
            <div class="User-box">
                <p>username: <span><?php echo $_SESSION['admin_name']; ?></span></p>
                <p>email: <span><?php echo $_SESSION['admin_email']; ?></span></p>
                <form method="post">
                    <button type="submit" name="logout" class="logout_btn">log out</button>
                </form>
            </div>
           </div>
            <img class="f" src="./image/logobeensi.png">
        <div class="banner">
            <div class="detail">
                <h1>the Purity</h1>
                <p>Step into a world of purity with our exceptional honey. Each jar reflects careful harvesting and a commitment to quality, offering you an authentic and unforgettable taste experience</p>
            </div>
        </div>
    </header> 
     
</body>
</html>